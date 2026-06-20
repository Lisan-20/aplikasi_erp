<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop procedure if exists
        DB::unprepared("IF OBJECT_ID('sp_DashboardKasir_GetMetrics', 'P') IS NOT NULL DROP PROCEDURE sp_DashboardKasir_GetMetrics");

        // Create procedure
        $sp = <<<SQL
CREATE PROCEDURE sp_DashboardKasir_GetMetrics
    @StartDate DATE,
    @EndDate DATE
AS
BEGIN
    SET NOCOUNT ON;

    -- 1. HEADER METRICS (Untuk Hari Ini)
    DECLARE @Today DATE = GETDATE();
    
    SELECT 
        SUM(tunai + debet) as TotalPendapatanHariIni,
        COUNT(no_registrasi) as TotalTransaksiHariIni,
        SUM(kredit) as TotalPiutangHariIni
    FROM tc_trans_kasir
    WHERE CAST(tgl_jam AS DATE) = @Today AND (status_batal IS NULL OR status_batal = 0);

    -- 2. TREN PENDAPATAN (Berdasarkan parameter StartDate - EndDate)
    SELECT 
        FORMAT(CAST(tgl_jam AS DATE), 'dd MMM') as name,
        SUM(tunai + debet + kredit) as revenue
    FROM tc_trans_kasir
    WHERE CAST(tgl_jam AS DATE) BETWEEN @StartDate AND @EndDate 
          AND (status_batal IS NULL OR status_batal = 0)
    GROUP BY CAST(tgl_jam AS DATE)
    ORDER BY CAST(tgl_jam AS DATE);

    -- 3. METODE PEMBAYARAN (Persentase Hari Ini)
    DECLARE @TotalTagihan DECIMAL(18,2) = (SELECT SUM(tunai + debet + kredit) FROM tc_trans_kasir WHERE CAST(tgl_jam AS DATE) = @Today AND (status_batal IS NULL OR status_batal = 0));
    IF @TotalTagihan IS NULL OR @TotalTagihan = 0 SET @TotalTagihan = 1; -- hindari div zero
    
    SELECT 
        'Tunai' as name, 
        CAST(ROUND((SUM(tunai) / @TotalTagihan) * 100, 0) AS INT) as value
    FROM tc_trans_kasir WHERE CAST(tgl_jam AS DATE) = @Today AND (status_batal IS NULL OR status_batal = 0)
    UNION ALL
    SELECT 
        'Debet / Transfer' as name, 
        CAST(ROUND((SUM(debet) / @TotalTagihan) * 100, 0) AS INT) as value
    FROM tc_trans_kasir WHERE CAST(tgl_jam AS DATE) = @Today AND (status_batal IS NULL OR status_batal = 0)
    UNION ALL
    SELECT 
        'Kredit / Tempo' as name, 
        CAST(ROUND((SUM(kredit) / @TotalTagihan) * 100, 0) AS INT) as value
    FROM tc_trans_kasir WHERE CAST(tgl_jam AS DATE) = @Today AND (status_batal IS NULL OR status_batal = 0);

END
SQL;
        DB::unprepared($sp);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("IF OBJECT_ID('sp_DashboardKasir_GetMetrics', 'P') IS NOT NULL DROP PROCEDURE sp_DashboardKasir_GetMetrics");
    }
};
