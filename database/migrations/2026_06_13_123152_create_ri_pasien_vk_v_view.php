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
        DB::statement("CREATE VIEW dbo.ri_pasien_vk_v
AS
SELECT     dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi, dbo.ri_cari_pasien_v.no_kunjungan, dbo.ri_cari_pasien_v.kode_ri, dbo.ri_cari_pasien_v.nama_pasien, 
                      dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kelas_pas, dbo.ri_pasien_vk.kode_klas, dbo.ri_pasien_vk.no_kamar_vk, dbo.ri_cari_pasien_v.kode_kelompok, dbo.ri_pasien_vk.flag_vk, 
                      dbo.ri_cari_pasien_v.dr_merawat, dbo.mt_ruangan.no_kamar, dbo.vk_pesan_ri.flag, dbo.ri_cari_pasien_v.kode_perusahaan, dbo.ri_cari_pasien_v.tgl_masuk
FROM         dbo.vk_pesan_ri RIGHT OUTER JOIN
                      dbo.ri_cari_pasien_v INNER JOIN
                      dbo.mt_ruangan ON dbo.ri_cari_pasien_v.kode_ruangan = dbo.mt_ruangan.kode_ruangan ON dbo.vk_pesan_ri.kode_ri = dbo.ri_cari_pasien_v.kode_ri LEFT OUTER JOIN
                      dbo.ri_pasien_vk ON dbo.ri_cari_pasien_v.kode_ri = dbo.ri_pasien_vk.kode_ri
WHERE     (dbo.ri_cari_pasien_v.bag_pas = '030501') OR
                      (dbo.ri_pasien_vk.no_kamar_vk IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_pasien_vk_v]");
    }
};
