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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_masuk_rinap_sensus_v
AS
SELECT     TOP (100) PERCENT dbo.ri_tc_riwayat_kelas.no_mr, dbo.ri_tc_riwayat_kelas.no_registrasi, dbo.mt_master_pasien.nama_pasien, 
                      dbo.ri_tc_riwayat_kelas.bagian_tujuan, dbo.ri_tc_riwayat_kelas.kelas_tujuan, dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.tc_registrasi.umur, 
                      dbo.tc_registrasi.diagnosa, dbo.mt_master_pasien.jen_kelamin, DAY(dbo.ri_tc_riwayat_kelas.tgl_masuk) AS tgl_msk, MONTH(dbo.ri_tc_riwayat_kelas.tgl_masuk) 
                      AS bln_msk, YEAR(dbo.ri_tc_riwayat_kelas.tgl_masuk) AS thn_msk, dbo.ri_tc_riwayat_kelas.ket_masuk, 1 AS status, dbo.mt_bagian.kode_depo_bag AS group_tujuan, 
                      dbo.ri_tc_riwayat_kelas.no_kamar_tujuan, dbo.ri_tc_riwayat_kelas.no_bed_tujuan, dbo.ri_tc_riwayat_kelas.kode_ruangan, dbo.ri_tc_rawatinap.tgl_keluar, 
                      dbo.ri_tc_rawatinap.tgl_masuk, COUNT(dbo.ri_tc_riwayat_kelas.no_registrasi) AS jml_psn
FROM         dbo.ri_tc_riwayat_kelas INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.ri_tc_riwayat_kelas.kode_ri = dbo.ri_tc_rawatinap.kode_ri INNER JOIN
                      dbo.mt_master_pasien ON dbo.ri_tc_riwayat_kelas.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_riwayat_kelas.bagian_tujuan = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_kunjungan.status_batal IS NULL)
GROUP BY dbo.ri_tc_riwayat_kelas.no_mr, dbo.ri_tc_riwayat_kelas.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_riwayat_kelas.bagian_tujuan, 
                      dbo.ri_tc_riwayat_kelas.kelas_tujuan, dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.tc_registrasi.umur, dbo.tc_registrasi.diagnosa, dbo.mt_master_pasien.jen_kelamin, 
                      DAY(dbo.ri_tc_riwayat_kelas.tgl_masuk), MONTH(dbo.ri_tc_riwayat_kelas.tgl_masuk), YEAR(dbo.ri_tc_riwayat_kelas.tgl_masuk), dbo.ri_tc_riwayat_kelas.ket_masuk, 
                      dbo.mt_bagian.kode_depo_bag, dbo.ri_tc_riwayat_kelas.no_kamar_tujuan, dbo.ri_tc_riwayat_kelas.no_bed_tujuan, dbo.ri_tc_riwayat_kelas.kode_ruangan, 
                      dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_riwayat_kelas.tgl_masuk
HAVING      (dbo.ri_tc_riwayat_kelas.ket_masuk = 1) AND (NOT (dbo.ri_tc_riwayat_kelas.bagian_asal LIKE '03%') OR
                      dbo.ri_tc_riwayat_kelas.bagian_asal IS NULL)
ORDER BY dbo.ri_tc_riwayat_kelas.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_masuk_rinap_sensus_v]");
    }
};
