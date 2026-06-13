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
        DB::statement("CREATE OR ALTER VIEW dbo.pl_tc_lap_poli_v
AS
SELECT     dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.tgl_jam_poli, dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.tgl_lhr, 
                      SUM(dbo.tc_trans_pelayanan.bill_rs + dbo.tc_trans_pelayanan.lain_lain) AS billing, dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.stat_pasien, 
                      dbo.tc_kunjungan.status_keluar, dbo.pl_tc_poli.kode_bagian AS kode_bagian_poli, dbo.pl_tc_poli.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.pl_tc_poli.kode_dokter = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.tgl_jam_poli, dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.kode_kelompok, dbo.pl_tc_poli.status_periksa, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.tc_kunjungan.status_keluar, dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.stat_pasien, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.kode_dokter, 
                      dbo.mt_karyawan.nama_pegawai
HAVING      (dbo.pl_tc_poli.status_periksa <> 0) AND (NOT (dbo.pl_tc_poli.status_periksa IS NULL))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_tc_lap_poli_v]");
    }
};
