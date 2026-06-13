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
        DB::statement("CREATE OR ALTER VIEW dbo.rm_data_pasien_diagnosa_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.no_mr, dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, dbo.mt_icd_diagnosa.nama_diagnosa, 
                      dbo.mt_master_pasien.kode_kelompok, dbo.mt_nasabah.nama_kelompok, dbo.mt_master_pasien.almt_ttp_pasien, dbo.tc_kunjungan.kode_dokter, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.tc_kunjungan.tgl_masuk
FROM         dbo.mt_nasabah INNER JOIN
                      dbo.mt_master_pasien ON dbo.mt_nasabah.kode_kelompok = dbo.mt_master_pasien.kode_kelompok RIGHT OUTER JOIN
                      dbo.tc_registrasi RIGHT OUTER JOIN
                      dbo.tc_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian AND 
                      dbo.tc_kunjungan.kode_bagian_asal = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.tc_kunjungan.no_kunjungan = dbo.th_riwayat_pasien.no_kunjungan INNER JOIN
                      dbo.mt_icd_diagnosa ON dbo.th_riwayat_pasien.kode_icd_diagnosa = dbo.mt_icd_diagnosa.kode_icd_diagnosa AND 
                      dbo.mt_bagian.kode_bagian = dbo.mt_icd_diagnosa.kode_bagian ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi ON 
                      dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
ORDER BY dbo.tc_kunjungan.kode_bagian_tujuan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rm_data_pasien_diagnosa_v]");
    }
};
