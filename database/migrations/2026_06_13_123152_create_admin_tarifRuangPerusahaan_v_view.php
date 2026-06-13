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
        DB::statement("CREATE VIEW dbo.admin_tarifRuangPerusahaan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.group_bag, dbo.mt_bagian.jumlah_kamar, 
                      dbo.mt_bagian.harga_kamar, dbo.mt_bagian.kelompok_unit, dbo.mt_bagian.validasi, dbo.mt_klas.nama_klas, dbo.mt_bagian.id_mt_bagian, 
                      dbo.mt_master_tarif_ruangan_perusahaan.kd_tarif_r_persh, dbo.mt_master_tarif_ruangan_perusahaan.harga_r, dbo.mt_master_tarif_ruangan_perusahaan.jumlah_k, 
                      dbo.mt_master_tarif_ruangan_perusahaan.harga_r_l, dbo.mt_master_tarif_ruangan_perusahaan.jumlah_tt, dbo.mt_master_tarif_ruangan_perusahaan.kode_klas, 
                      dbo.mt_master_tarif_ruangan_perusahaan.kode_perusahaan, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_master_tarif_ruangan_perusahaan.keterangan
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_master_tarif_ruangan_perusahaan ON dbo.mt_bagian.kode_bagian = dbo.mt_master_tarif_ruangan_perusahaan.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_ruangan_perusahaan.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_perusahaan ON dbo.mt_master_tarif_ruangan_perusahaan.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
ORDER BY dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_tarifRuangPerusahaan_v]");
    }
};
