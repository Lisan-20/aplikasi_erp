<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW dbo.lap_kunjungan_update_kelas_sum_v
AS
SELECT     dbo.lap_kunjungan_gizi_kelas_sum_v.kelas_I, dbo.lap_kunjungan_gizi_kelas_sum_v.kelas_II, dbo.lap_kunjungan_gizi_kelas_sum_v.kelas_III, dbo.lap_kunjungan_gizi_kelas_sum_v.vvip, 
                      dbo.lap_kunjungan_gizi_kelas_sum_v.vip, dbo.lap_kunjungan_gizi_temp.tgl, dbo.lap_kunjungan_gizi_temp.bln, dbo.lap_kunjungan_gizi_temp.thn, dbo.lap_kunjungan_gizi_temp.kelas_vvip, 
                      dbo.lap_kunjungan_gizi_temp.kelas_vip, dbo.lap_kunjungan_gizi_temp.kelas_I AS kelasI, dbo.lap_kunjungan_gizi_temp.kelas_II AS kelasII, dbo.lap_kunjungan_gizi_temp.kelas_III AS kelasIII, 
                      dbo.lap_kunjungan_gizi_kelas_sum_v.distribusi, dbo.lap_kunjungan_gizi_temp.distribusi AS Expr1
FROM         dbo.lap_kunjungan_gizi_temp INNER JOIN
                      dbo.lap_kunjungan_gizi_kelas_sum_v ON dbo.lap_kunjungan_gizi_temp.tgl = dbo.lap_kunjungan_gizi_kelas_sum_v.tgl AND 
                      dbo.lap_kunjungan_gizi_temp.bln = dbo.lap_kunjungan_gizi_kelas_sum_v.bln AND dbo.lap_kunjungan_gizi_temp.thn = dbo.lap_kunjungan_gizi_kelas_sum_v.thn AND 
                      dbo.lap_kunjungan_gizi_temp.distribusi = dbo.lap_kunjungan_gizi_kelas_sum_v.distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_update_kelas_sum_v]");
    }
};
