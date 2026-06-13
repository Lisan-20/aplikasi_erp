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
        DB::statement("CREATE VIEW dbo.ri_cari_pasien2_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, dbo.mt_master_pasien.nama_pasien, 
                      dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, 
                      dbo.ri_tc_rawatinap.bag_ibu, dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, dbo.ri_tc_rawatinap.status_cuti, dbo.tc_registrasi.status_registrasi, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.ri_tc_rawatinap.no_jkn, dbo.ri_tc_rawatinap.kode_plafon, dbo.ri_tc_rawatinap.plafon_bpjs AS plafon_old, 
                      dbo.ri_tc_rawatinap.diagnosa_awal, dbo.ri_tc_rawatinap.icd10, dbo.ri_tc_rawatinap.icd9, dbo.ri_tc_rawatinap.jatah_klas, dbo.tc_registrasi.no_jkn AS Expr1, dbo.tc_registrasi.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk AS Expr2, dbo.tc_kunjungan.status_batal, dbo.mt_bagian.nama_bagian, dbo.mt_klas.nama_klas, dbo.tc_registrasi.umur, 
                      dbo.mt_master_pasien.almt_ttp_pasien AS alamat, dbo.ri_tc_rawatinap.catatan, dbo.tc_registrasi.noSep, dbo.tc_kunjungan.tgl_blpl, dbo.tc_registrasi.id_paket, dbo.tc_kunjungan.status_keluar, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.status_blpl, dbo.tc_kunjungan.tgl_pulang, dbo.tc_registrasi.plafon_bpjs, dbo.mt_master_pasien.mr_ibu, dbo.mt_nasabah.nama_kelompok, 
                      dbo.mt_bagian.kode_depo_bag, CASE WHEN daftar_ol IS NULL THEN 1 ELSE flag_verif END AS filter_verif_ol, dbo.tc_registrasi.ttd_sk_pasien, dbo.tc_registrasi.ttd, dbo.tc_kunjungan.tgl_serah, 
                      dbo.tc_kunjungan.flag_serah, dbo.tc_kunjungan.no_induk, dbo.tc_registrasi.ttd_ri
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.ri_tc_rawatinap.status_pulang < 1) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_cari_pasien2_v]");
    }
};
