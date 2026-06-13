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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_bedah_v
AS
SELECT     dbo.tarif_bedah_level3_v.nama_tarif AS level3, dbo.tarif_bedah_level4_v.nama_tarif AS level4, dbo.tarif_bedah_level5_v.nama_tarif AS level5, 
                      dbo.tarif_bedah_level5_v.kode_tarif, dbo.tarif_bedah_level5_v.kode_tindakan, dbo.tarif_bedah_level5_v.referensi, dbo.tarif_bedah_level5_v.tingkatan, 
                      dbo.tarif_bedah_level5_v.kode_bagian, dbo.mt_master_tarif_detail.kode_master_tarif_detail, dbo.mt_master_tarif_detail.kode_klas, dbo.mt_klas.nama_klas, 
                      dbo.mt_master_tarif_detail.bill_rs, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.bill_dr3, dbo.mt_master_tarif_detail.bill_dr2, 
                      dbo.mt_master_tarif_detail.bhp, dbo.mt_master_tarif_detail.pendapatan_rs, dbo.mt_master_tarif_detail.paramedis
FROM         dbo.tarif_bedah_level3_v INNER JOIN
                      dbo.tarif_bedah_level4_v ON dbo.tarif_bedah_level3_v.kode_tarif = dbo.tarif_bedah_level4_v.referensi INNER JOIN
                      dbo.tarif_bedah_level5_v ON dbo.tarif_bedah_level4_v.kode_tarif = dbo.tarif_bedah_level5_v.referensi INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tarif_bedah_level5_v.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail.kode_klas = dbo.mt_klas.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_bedah_v]");
    }
};
