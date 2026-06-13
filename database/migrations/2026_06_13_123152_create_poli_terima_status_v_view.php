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
        DB::statement("CREATE VIEW dbo.poli_terima_status_v
AS
SELECT     TOP (100) PERCENT dbo.pl_tc_poli.id_pl_tc_poli, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.tgl_jam_poli, 
                      dbo.pl_tc_poli.kode_dokter, dbo.pl_tc_poli.kode_resep, dbo.pl_tc_poli.kode_gcu, dbo.pl_tc_poli.status_periksa, dbo.pl_tc_poli.no_induk, dbo.tc_kunjungan.no_mr, 
                      dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_agama, dbo.mt_master_pasien.kode_pendidikan, dbo.tc_kunjungan.no_registrasi, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.gol_darah, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.pl_tc_poli.kode_bagian AS kode_bagian_poli, dbo.mt_master_pasien.almt_ttp_pasien AS alamat_pasien, dbo.mt_master_pasien.nik, 
                      dbo.tc_registrasi.umur, dbo.pl_tc_poli.kode_jadwal, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.flag_status, CAST(RIGHT(dbo.tc_kunjungan.no_mr, 2) 
                      AS int) AS DIGIT
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.pl_tc_poli.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.pl_tc_poli.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_registrasi.flag_status = 1)
ORDER BY dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [poli_terima_status_v]");
    }
};
