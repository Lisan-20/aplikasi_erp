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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_pendahtaran_sum_v
AS
SELECT     dbo.tc_registrasi.no_induk, dbo.mt_karyawan.nama_pegawai, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, 
                      DAY(dbo.tc_registrasi.tgl_jam_masuk) AS tgl, dbo.mt_bagian.nama_bagian, dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, 
                      COUNT(dbo.tc_kunjungan.no_kunjungan) AS jml, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.status_batal AS Expr1
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.no_induk = dbo.mt_karyawan.no_induk
GROUP BY dbo.tc_registrasi.no_induk, dbo.mt_karyawan.nama_pegawai, dbo.tc_registrasi.status_batal, YEAR(dbo.tc_registrasi.tgl_jam_masuk), 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk), DAY(dbo.tc_registrasi.tgl_jam_masuk), dbo.mt_bagian.nama_bagian, dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.tc_kunjungan.status_batal
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_pendahtaran_sum_v]");
    }
};
