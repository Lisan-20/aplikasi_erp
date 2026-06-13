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
        DB::statement("CREATE VIEW dbo.upload_tarif_bedah_jpk_v
AS
SELECT     dbo.Upload_lagi.kode_tarif, dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4, dbo.mt_master_tarif_detail_bedah.kode_klas, dbo.mt_master_tarif_detail_bedah.no_urut, 
                      dbo.Upload_lagi.bill_rs_inhealth, dbo.Upload_lagi.bill_dr1_inhealth, dbo.Upload_lagi.total_inhealth1, dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth AS bill_rs_inhealth_mt, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth AS bill_dr1_inhealth_mt, dbo.mt_master_tarif_detail_bedah.total_inhealth1 AS total_inhealth1_mt, dbo.Upload_lagi.bill_rs_cahaya, 
                      dbo.Upload_lagi.bill_dr1_cahaya, dbo.Upload_lagi.total_cahaya, dbo.mt_master_tarif_detail_bedah.bill_rs_cahaya AS bill_rs_cahaya_mt, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_cahaya AS bill_dr1_cahaya_mt, dbo.mt_master_tarif_detail_bedah.total_cahaya AS total_cahaya_mt, dbo.Upload_lagi.bill_rs_kapitasi, 
                      dbo.Upload_lagi.bill_dr1_kapitasi, dbo.Upload_lagi.total_kapitasi, dbo.mt_master_tarif_detail_bedah.bill_rs_kapitasi AS bill_rs_kapitasi_mt, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_kapitasi AS bill_dr1_kapitasi_mt, dbo.mt_master_tarif_detail_bedah.total_kapitasi AS total_kapitasi_mt
FROM         dbo.Upload_lagi INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.Upload_lagi.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif AND dbo.Upload_lagi.kode_klas = dbo.mt_master_tarif_detail_bedah.kode_klas AND
                       dbo.Upload_lagi.no_urut = dbo.mt_master_tarif_detail_bedah.no_urut
WHERE     (dbo.mt_master_tarif_detail_bedah.no_urut IN (2, 3))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upload_tarif_bedah_jpk_v]");
    }
};
