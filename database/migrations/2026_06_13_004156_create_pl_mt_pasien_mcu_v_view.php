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
        DB::statement("CREATE OR ALTER VIEW dbo.pl_mt_pasien_mcu_v
AS
SELECT     TOP (100) PERCENT dbo.pl_tc_poli.id_pl_tc_poli, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian, 
                      dbo.pl_tc_poli.tgl_jam_poli, dbo.pl_tc_poli.kode_dokter, dbo.pl_tc_poli.kode_resep, dbo.pl_tc_poli.kode_gcu, dbo.pl_tc_poli.status_periksa, dbo.pl_tc_poli.no_induk, 
                      dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, 
                      dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, 
                      dbo.pl_tc_poli.kode_bagian AS kode_bagian_poli, dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, dbo.tc_registrasi.id_paket, dbo.tc_registrasi.umur, 
                      dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.pekerjaan, dbo.tc_registrasi.status_batal
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.pl_tc_poli.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_kunjungan.tgl_keluar IS NULL) AND (dbo.pl_tc_poli.kode_bagian = '011801') AND (dbo.tc_registrasi.id_paket > 0) AND (dbo.tc_registrasi.status_batal IS NULL)
ORDER BY dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien_mcu_v]");
    }
};
