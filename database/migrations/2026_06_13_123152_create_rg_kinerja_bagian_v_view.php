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
        DB::statement("
CREATE VIEW dbo.rg_kinerja_bagian_v
AS
SELECT     dbo.rg_master_pasien_v.no_mr, dbo.rg_master_pasien_v.nama_pasien, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.umur, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.tgl_masuk, 
                      dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_masuk, dbo.tc_kunjungan.status_keluar, 
                      dbo.tc_registrasi.kode_kelompok, dbo.mt_nasabah.nama_kelompok, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.kode_dokter, 
                      dbo.rg_master_pasien_v.jen_kelamin
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.rg_master_pasien_v ON dbo.tc_registrasi.no_mr = dbo.rg_master_pasien_v.no_mr INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_kinerja_bagian_v]");
    }
};
