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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_L_Rugi_all_vol_v
AS
SELECT     TOP (100) PERCENT COUNT(dbo.tc_kunjungan.no_registrasi) AS vol, dbo.tc_kunjungan.kode_bagian_tujuan, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) 
                      AS thn
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL)
GROUP BY dbo.tc_kunjungan.kode_bagian_tujuan, MONTH(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam)
ORDER BY bln, thn, dbo.tc_kunjungan.kode_bagian_tujuan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_all_vol_v]");
    }
};
