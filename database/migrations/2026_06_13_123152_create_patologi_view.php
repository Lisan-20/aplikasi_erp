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
        DB::statement("CREATE OR ALTER VIEW dbo.patologi
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.referensi, dbo.mt_master_tarif_detail.bill_rs, 
                      dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.total, dbo.mt_master_tarif_detail.bill_rs_pt, dbo.mt_master_tarif_detail.bill_dr1_pt, 
                      dbo.mt_master_tarif_detail.bill_rs_ass, dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail.bill_rs_inhealth, dbo.mt_master_tarif_detail.bill_dr1_inhealth, dbo.mt_master_tarif_detail.total_inhealth, 
                      dbo.mt_master_tarif_detail.total_pt, dbo.mt_master_tarif_detail.total_ass, dbo.mt_master_tarif_detail.total_bpjs, dbo.mt_master_tarif_detail.bill_rs_nayaka, 
                      dbo.mt_master_tarif_detail.bill_dr1_nayaka, dbo.mt_master_tarif_detail.bill_rs_hardlent, dbo.mt_master_tarif_detail.bill_dr1_hardlent, 
                      dbo.mt_master_tarif_detail.bill_rs_cahaya, dbo.mt_master_tarif_detail.bill_dr1_cahaya, dbo.mt_master_tarif_detail.total_cahaya, 
                      dbo.mt_master_tarif_detail.total_hardlent, dbo.mt_master_tarif_detail.total_nayaka
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.mt_master_tarif.kode_bagian = '050101') AND (dbo.mt_master_tarif.referensi = '501011600')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [patologi]");
    }
};
