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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_registrasi_ol_v
AS
SELECT     dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_registrasi.tgl_jam_masuk, 
                      dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_kunjungan, dbo.pl_tc_poli.no_antrian, dbo.pl_tc_poli.datang
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                      dbo.tc_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_registrasi_ol_v]");
    }
};
