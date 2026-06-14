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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_bedah2_v
AS
SELECT     dbo.tarif_bedah_level3_vk_v.nama_tarif AS level3, dbo.tarif_bedah_level4_vk_v.nama_tarif AS level4, dbo.tarif_bedah_level5_vk_v.nama_tarif AS level5, dbo.tarif_bedah_level5_vk_v.kode_tarif, 
                      dbo.tarif_bedah_level5_vk_v.kode_tindakan, dbo.tarif_bedah_level5_vk_v.referensi, dbo.tarif_bedah_level5_vk_v.tingkatan, dbo.tarif_bedah_level5_vk_v.kode_bagian, 
                      dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_klas.nama_klas, SUM(dbo.mt_master_tarif_detail_bedah.bill_rs) AS bill_rs, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr1) AS bill_dr1, 
                      SUM(dbo.mt_master_tarif_detail_bedah.bill_dr3) AS bill_dr3, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr2) AS bill_dr2, SUM(dbo.mt_master_tarif_detail_bedah.bhp) AS bhp, 
                      SUM(dbo.mt_master_tarif_detail_bedah.pendapatan_rs) AS pendapatan_rs, SUM(dbo.mt_master_tarif_detail_bedah.paramedis) AS paramedis
FROM         dbo.tarif_bedah_level3_vk_v INNER JOIN
                      dbo.tarif_bedah_level4_vk_v ON dbo.tarif_bedah_level3_vk_v.kode_tarif = dbo.tarif_bedah_level4_vk_v.referensi INNER JOIN
                      dbo.tarif_bedah_level5_vk_v ON dbo.tarif_bedah_level4_vk_v.kode_tarif = dbo.tarif_bedah_level5_vk_v.referensi INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.tarif_bedah_level5_vk_v.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.mt_klas.kode_klas
GROUP BY dbo.tarif_bedah_level3_vk_v.nama_tarif, dbo.tarif_bedah_level4_vk_v.nama_tarif, dbo.tarif_bedah_level5_vk_v.nama_tarif, dbo.tarif_bedah_level5_vk_v.kode_tarif, 
                      dbo.tarif_bedah_level5_vk_v.kode_tindakan, dbo.tarif_bedah_level5_vk_v.referensi, dbo.tarif_bedah_level5_vk_v.tingkatan, dbo.tarif_bedah_level5_vk_v.kode_bagian, 
                      dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_klas.nama_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah2_v]");
    }
};
