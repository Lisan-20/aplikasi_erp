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
        DB::statement("CREATE OR ALTER VIEW dbo.riwayat_pasien_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.kode_dokter, dbo.tc_trans_kasir.status_batal
FROM         dbo.pm_tc_penunjang RIGHT OUTER JOIN
                      dbo.ri_tc_rawatinap RIGHT OUTER JOIN
                      dbo.gd_tc_gawat_darurat RIGHT OUTER JOIN
                      dbo.tc_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi ON 
                      dbo.gd_tc_gawat_darurat.no_kunjungan = dbo.tc_kunjungan.no_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan ON 
                      dbo.pm_tc_penunjang.no_kunjungan = dbo.tc_kunjungan.no_kunjungan LEFT OUTER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan
WHERE     (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan <> '030001') AND (dbo.tc_trans_kasir.status_batal IS NULL)
ORDER BY dbo.tc_kunjungan.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [riwayat_pasien_v]");
    }
};
