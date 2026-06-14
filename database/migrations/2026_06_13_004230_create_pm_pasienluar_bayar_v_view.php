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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pasienluar_bayar_v
AS
SELECT     status_batal, stat_pasien, no_kunjungan, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, keterangan, kode_penunjang, tgl_daftar, 
                      kode_bagian, no_antrian, tgl_isihasil, no_foto, dr_pengirim, petugas_input, status_daftar, radiografer, petugas_isihasil, catatan_hasil, status_isihasil, no_induk, kode_perusahaan, no_registrasi, 
                      kode_klas, nama_pasien, no_mr, jen_kelamin, no_hasil_pm, status_bayar, kode_kelompok, YEAR(tgl_daftar) AS tahun, status_man, no_tlp
FROM         dbo.pm_pasienluar_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienluar_bayar_v]");
    }
};
