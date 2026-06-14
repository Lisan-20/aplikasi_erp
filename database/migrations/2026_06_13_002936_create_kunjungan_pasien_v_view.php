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
        DB::statement("CREATE OR ALTER VIEW dbo.kunjungan_pasien_v
AS
SELECT     dbo.mt_nasabah.nama_kelompok, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.umur, dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kunjungan_pasien_v]");
    }
};
