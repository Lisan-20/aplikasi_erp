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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_gizi_sensen_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, 
                      dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, 
                      dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, dbo.ri_tc_rawatinap.bag_ibu, 
                      dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, 
                      dbo.ri_tc_rawatinap.status_cuti, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.ri_tc_rawatinap.no_jkn, dbo.ri_tc_rawatinap.kode_plafon, dbo.ri_tc_rawatinap.plafon_bpjs, dbo.ri_tc_rawatinap.diagnosa_awal, 
                      dbo.ri_tc_rawatinap.icd10, dbo.ri_tc_rawatinap.icd9, dbo.ri_tc_rawatinap.jatah_klas, dbo.tc_registrasi.no_jkn AS Expr1, dbo.tc_registrasi.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk AS Expr2, dbo.tc_kunjungan.status_batal, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_klas.nama_klas, dbo.tc_registrasi.umur
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.ri_tc_rawatinap.status_pulang < 1) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_gizi_sensen_v]");
    }
};
