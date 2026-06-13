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
        DB::statement("CREATE VIEW dbo.ri_cari_pasien_jkn_v3
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, dbo.mt_master_pasien.nama_pasien, 
                      dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, 
                      dbo.ri_tc_rawatinap.bag_ibu, dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, dbo.ri_tc_rawatinap.status_cuti, dbo.tc_registrasi.status_registrasi, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.ri_tc_rawatinap.no_jkn, dbo.ri_tc_rawatinap.kode_plafon, dbo.ri_tc_rawatinap.plafon_bpjs, 
                      dbo.ri_tc_rawatinap.diagnosa_awal, dbo.ri_tc_rawatinap.icd10, dbo.ri_tc_rawatinap.icd9, dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.status_batal AS batal, 
                      dbo.ri_tc_rawatinap.status_batal AS batal_ri, dbo.ri_tc_rawatinap.alos, dbo.tc_registrasi.noSep, dbo.mt_perusahaan.nama_perusahaan, dbo.tc_registrasi.no_jaminan, 
                      dbo.mt_karyawan.nama_pegawai AS dokter, dbo.mt_bagian.nama_bagian AS spesialis, dbo.tc_registrasi.diagAwal
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_karyawan ON dbo.ri_tc_rawatinap.dr_merawat = dbo.mt_karyawan.kode_dokter LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.ri_tc_rawatinap.status_pulang < 1) AND (dbo.tc_registrasi.kode_kelompok IN (8, 9, 11)) AND (dbo.tc_kunjungan.status_batal IS NULL) OR
                      (dbo.ri_tc_rawatinap.status_pulang < 1) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.mt_perusahaan.nama_perusahaan LIKE '%COB%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_cari_pasien_jkn_v3]");
    }
};
