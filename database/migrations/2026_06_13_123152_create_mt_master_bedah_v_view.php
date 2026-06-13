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
        DB::statement("CREATE VIEW dbo.mt_master_bedah_v
AS
SELECT     dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.bill_rs, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1, dbo.mt_master_tarif_detail_bedah.bill_dr2, dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif_detail_bedah.obat, 
                      dbo.mt_master_tarif_detail_bedah.alkes, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.total_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2_inhealth, dbo.mt_master_tarif_detail_bedah.total_inhealth1, dbo.mt_master_tarif_detail_bedah.bill_dr1_ass, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2_ass, dbo.mt_master_tarif_detail_bedah.bill_rs_ass, dbo.mt_master_tarif_detail_bedah.total_ass1
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_master_bedah_v]");
    }
};
