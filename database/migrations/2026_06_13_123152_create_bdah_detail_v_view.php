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
        DB::statement("CREATE OR ALTER VIEW dbo.bdah_detail_v
AS
SELECT     dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_klas.nama_klas, dbo.mt_master_tarif_detail_bedah.no_urut, dbo.mt_master_tarif_detail_bedah.detail, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif_detail_bedah.bill_rs_nayaka, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_nayaka, dbo.mt_master_tarif_detail_bedah.total_nayaka, dbo.mt_master_tarif_detail_bedah.bill_rs_hardlent, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_hardlent, dbo.mt_master_tarif_detail_bedah.total_hardlent, dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, dbo.mt_master_tarif_detail_bedah.total_inhealth1, dbo.mt_master_tarif_detail_bedah.bill_rs_cahaya, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_cahaya, dbo.mt_master_tarif_detail_bedah.total_cahaya, dbo.mt_master_tarif_detail_bedah.bill_rs_kapitasi, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_kapitasi, dbo.mt_master_tarif_detail_bedah.total_kapitasi, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.total_bpjs
FROM         dbo.mt_master_tarif_detail_bedah INNER JOIN
                      dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif INNER JOIN
                      dbo.mt_klas ON dbo.mt_master_tarif_detail_bedah.kode_klas = dbo.mt_klas.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bdah_detail_v]");
    }
};
