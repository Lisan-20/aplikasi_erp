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
        DB::statement("CREATE OR ALTER VIEW dbo.tarif_bedah_baru_2016_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_bagian, dbo.mt_master_tarif.referensi, dbo.mt_master_tarif_detail_bedah.kode_klas, 
                      dbo.mt_master_tarif_detail_bedah.detail, dbo.mt_master_tarif_detail_bedah.bill_rs, dbo.mt_master_tarif_detail_bedah.bill_dr1, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr2, dbo.mt_master_tarif_detail_bedah.obat, dbo.mt_master_tarif_detail_bedah.alkes, 
                      dbo.mt_master_tarif_detail_bedah.alat_rs, dbo.mt_master_tarif_detail_bedah.adm, dbo.mt_master_tarif_detail_bedah.bhp, dbo.mt_master_tarif_detail_bedah.bill_dr3, 
                      dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr1_inhealth, dbo.mt_master_tarif_detail_bedah.bill_dr2_inhealth, 
                      dbo.mt_master_tarif_detail_bedah.no_urut, dbo.mt_master_tarif_detail_bedah.total_bpjs, dbo.mt_master_tarif_detail_bedah.total_inhealth1, 
                      dbo.mt_master_tarif_detail_bedah.total, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif.kode_tarif
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tarif_bedah_baru_2016_v]");
    }
};
