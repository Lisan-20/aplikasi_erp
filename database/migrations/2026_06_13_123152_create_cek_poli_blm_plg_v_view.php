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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_poli_blm_plg_v
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_kunjungan.tgl_keluar, dbo.pl_tc_poli.kode_bagian, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.pl_tc_poli.tgl_jam_poli, 
                      dbo.tc_registrasi.no_registrasi, dbo.pl_tc_poli.kode_poli, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.status_keluar, dbo.tc_registrasi.status_batal, 
                      dbo.tc_kunjungan.status_batal AS Expr1
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi
WHERE     (dbo.tc_trans_kasir.kode_tc_trans_kasir > 0) AND (dbo.tc_kunjungan.tgl_keluar IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND 
                      (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_poli_blm_plg_v]");
    }
};
