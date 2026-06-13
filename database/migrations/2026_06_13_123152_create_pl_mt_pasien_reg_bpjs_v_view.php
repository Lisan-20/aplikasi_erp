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
        DB::statement("CREATE VIEW dbo.pl_mt_pasien_reg_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.pl_tc_poli.id_pl_tc_poli, dbo.pl_tc_poli.kode_poli, dbo.pl_tc_poli.no_kunjungan, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.tgl_jam_poli, 
                      dbo.pl_tc_poli.kode_dokter, dbo.pl_tc_poli.kode_resep, dbo.pl_tc_poli.kode_gcu, dbo.pl_tc_poli.status_periksa, dbo.pl_tc_poli.no_induk, dbo.tc_kunjungan.no_mr, 
                      dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.tgl_masuk AS xx, dbo.tc_kunjungan.tgl_keluar, 
                      dbo.pl_tc_poli.kode_bagian AS kode_bagian_poli, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.mt_karyawan.no_induk AS no_induk_dokter, 
                      dbo.tc_registrasi.status_batal, dbo.pl_tc_poli.kode_jadwal, dbo.pl_tc_poli.status_isihasil, dbo.tc_registrasi.noSep, dbo.tc_registrasi.noKartuPeserta, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.jadwal_dokter.jadwal_dokter, dbo.jadwal_dokter.periksa, dbo.jadwal_dokter.mulai, dbo.pl_tc_poli.no_antrian * dbo.jadwal_dokter.periksa AS Expr1, 
                      dbo.pl_tc_poli.no_antrian * dbo.jadwal_dokter.periksa / 60 AS Expr2, dbo.pl_tc_poli.no_antrian * dbo.jadwal_dokter.periksa / 60 + dbo.jadwal_dokter.mulai AS datang, CONVERT(VARCHAR(10), 
                      dbo.tc_registrasi.tgl_jam_masuk, 105) AS tgl_masuk, CONVERT(VARCHAR(10), dbo.tc_registrasi.tgl_jam_masuk, 23) AS tgl_masuk_poli, dbo.tc_registrasi.daftar_ol, dbo.pl_tc_poli.status_bayar, 
                      dbo.mt_bagian.kode_poli_vclaim, dbo.tc_registrasi.kode_booking, dbo.tc_registrasi.no_antrian_jkn, dbo.mt_karyawan.kode_dokter_hfis, dbo.tc_registrasi.tgl_checkin
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.pl_tc_poli.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.jadwal_dokter ON dbo.pl_tc_poli.kode_jadwal = dbo.jadwal_dokter.kode_jadwal LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.pl_tc_poli.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_registrasi.status_batal IS NULL)
ORDER BY dbo.pl_tc_poli.id_pl_tc_poli DESC, dbo.pl_tc_poli.kode_bagian, dbo.pl_tc_poli.no_antrian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pl_mt_pasien_reg_bpjs_v]");
    }
};
