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
        DB::statement("CREATE VIEW dbo.vk_pesan_ri_v
AS
SELECT     dbo.vk_pesan_ri.id_pesan_vk, dbo.vk_pesan_ri.tanggal, dbo.vk_pesan_ri.no_mr, dbo.vk_pesan_ri.kode_bagian, dbo.vk_pesan_ri.no_kunjungan, 
                      dbo.vk_pesan_ri.no_registrasi, dbo.vk_pesan_ri.kode_ri, dbo.vk_pesan_ri.kode_kelompok, dbo.vk_pesan_ri.kode_perusahaan, dbo.vk_pesan_ri.kode_dokter, 
                      dbo.vk_pesan_ri.kode_ruangan, dbo.vk_pesan_ri.nama_pasien, dbo.vk_pesan_ri.kode_klas, dbo.vk_pesan_ri.flag, dbo.mt_perusahaan.nama_perusahaan, 
                      dbo.mt_nasabah.nama_kelompok
FROM         dbo.vk_pesan_ri INNER JOIN
                      dbo.mt_nasabah ON dbo.vk_pesan_ri.kode_kelompok = dbo.mt_nasabah.kode_kelompok LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.vk_pesan_ri.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [vk_pesan_ri_v]");
    }
};
