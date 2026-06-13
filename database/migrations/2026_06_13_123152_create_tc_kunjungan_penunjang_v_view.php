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
        DB::statement("CREATE VIEW dbo.tc_kunjungan_penunjang_v
AS
SELECT     dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.umur, dbo.tc_kunjungan.kode_dokter, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_batal, 
                      CASE WHEN kode_bagian_tujuan LIKE '03%' THEN mt_bagian.kode_depo_bag ELSE kode_bagian_tujuan END AS kd_bag, dbo.mt_bagian.kode_depo_bag, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.no_registrasi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '05%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kunjungan_penunjang_v]");
    }
};
