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
        DB::statement("CREATE VIEW dbo.sum_jml_pasien_ranap_v
AS
SELECT        COUNT(dbo.tc_registrasi.no_registrasi) AS jml_pasien, dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, DAY(dbo.ri_tc_rawatinap.tgl_keluar) 
                         AS tgl_plg, MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS bln_plg, YEAR(dbo.ri_tc_rawatinap.tgl_keluar) AS thn_plg, dbo.ri_tc_rawatinap.status_pulang, 
                         DAY(dbo.ri_tc_rawatinap.tgl_masuk) AS tgl_msk, MONTH(dbo.tc_kunjungan.tgl_masuk) AS bln_msk, YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn_msk, 
                         dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.status_keluar, dbo.ri_tc_riwayat_kelas.ket_pindah, dbo.mt_bagian.status_aktif, 
                         dbo.ri_tc_riwayat_kelas.no_bed_asal, dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.ri_tc_riwayat_kelas.no_bed_tujuan, dbo.ri_tc_riwayat_kelas.bagian_tujuan
FROM            dbo.tc_kunjungan INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                         dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                         dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                         dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri LEFT OUTER JOIN
                         dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, YEAR(dbo.ri_tc_rawatinap.tgl_keluar), DAY(dbo.ri_tc_rawatinap.tgl_masuk), 
                         DAY(dbo.ri_tc_rawatinap.tgl_keluar), MONTH(dbo.ri_tc_rawatinap.tgl_keluar), dbo.ri_tc_rawatinap.status_pulang, YEAR(dbo.tc_kunjungan.tgl_masuk), 
                         MONTH(dbo.tc_kunjungan.tgl_masuk), dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.status_keluar, dbo.ri_tc_riwayat_kelas.ket_pindah, 
                         dbo.mt_bagian.status_aktif, dbo.ri_tc_riwayat_kelas.no_bed_asal, dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.ri_tc_riwayat_kelas.no_bed_tujuan, 
                         dbo.ri_tc_riwayat_kelas.bagian_tujuan
HAVING        (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.mt_bagian.status_aktif = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_jml_pasien_ranap_v]");
    }
};
