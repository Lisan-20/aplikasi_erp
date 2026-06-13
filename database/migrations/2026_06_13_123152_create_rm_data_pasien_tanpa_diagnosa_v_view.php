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
        DB::statement("CREATE VIEW dbo.rm_data_pasien_tanpa_diagnosa_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai, dbo.mt_nasabah.nama_kelompok, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.tc_kunjungan.kode_dokter, dbo.mt_master_pasien.tgl_lhr, dbo.tc_kunjungan.tgl_masuk, 
                      dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.no_mr
FROM         dbo.mt_master_pasien RIGHT OUTER JOIN
                      dbo.tc_registrasi INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok ON 
                      dbo.mt_master_pasien.no_mr = dbo.tc_registrasi.no_mr RIGHT OUTER JOIN
                      dbo.mt_karyawan RIGHT OUTER JOIN
                      dbo.tc_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian AND 
                      dbo.tc_kunjungan.kode_bagian_asal = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi ON dbo.mt_karyawan.kode_dokter = dbo.tc_kunjungan.kode_dokter ON 
                      dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan NOT IN ('030001'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rm_data_pasien_tanpa_diagnosa_v]");
    }
};
