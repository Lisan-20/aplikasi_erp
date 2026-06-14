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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_pasien_plang_ri_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, dbo.mt_master_pasien.nama_pasien, 
                      dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, 
                      dbo.ri_tc_rawatinap.bag_ibu, dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.ri_tc_rawatinap.jatah_klas, dbo.ri_tc_rawatinap.plafon_bpjs, dbo.ri_tc_rawatinap.diagnosa_awal, dbo.ri_tc_rawatinap.no_jkn, dbo.ri_tc_rawatinap.kode_plafon, 
                      YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, dbo.mt_bagian.nama_bagian, dbo.mt_klas.nama_klas, 
                      dbo.tc_registrasi.stat_pasien, dbo.th_riwayat_pasien_grup.diagnosa_akhir, dbo.mt_master_pasien.flag_kelamin, dbo.tc_registrasi.umur, dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.tc_kunjungan.status_keluar
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.th_riwayat_pasien_grup ON dbo.tc_kunjungan.no_kunjungan = dbo.th_riwayat_pasien_grup.no_kunjungan
WHERE     (dbo.ri_tc_rawatinap.status_pulang = 1)
ORDER BY dbo.tc_kunjungan.tgl_keluar DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_pasien_plang_ri_v]");
    }
};
