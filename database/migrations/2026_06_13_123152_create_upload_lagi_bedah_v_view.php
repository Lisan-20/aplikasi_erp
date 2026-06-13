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
        DB::statement("CREATE OR ALTER VIEW dbo.upload_lagi_bedah_v
AS
SELECT     TOP (100) PERCENT dbo.bedah_upload_v.kode_tarif, dbo.bedah_upload_v.nama_tarif, mt_master_tarif_detail_bedah_1.kode, mt_master_tarif_detail_bedah_1.kode_klas, 
                      mt_master_tarif_detail_bedah_1.bill_rs, mt_master_tarif_detail_bedah_1.bill_dr1, mt_master_tarif_detail_bedah_1.bill_dr2, mt_master_tarif_detail_bedah_1.kode_tgl_tarif, 
                      mt_master_tarif_detail_bedah_1.kode_tarif AS tarif_code, mt_master_tarif_detail_bedah_1.total, mt_master_tarif_detail_bedah_1.obat, mt_master_tarif_detail_bedah_1.alkes, 
                      mt_master_tarif_detail_bedah_1.alat_rs, mt_master_tarif_detail_bedah_1.adm, mt_master_tarif_detail_bedah_1.bhp, mt_master_tarif_detail_bedah_1.keterangan, 
                      mt_master_tarif_detail_bedah_1.pendapatan_rs, mt_master_tarif_detail_bedah_1.bill_dr3, mt_master_tarif_detail_bedah_1.kamar_tindakan, mt_master_tarif_detail_bedah_1.paramedis, 
                      mt_master_tarif_detail_bedah_1.detail, mt_master_tarif_detail_bedah_1.no_urut, mt_master_tarif_detail_bedah_1.bill_dr1_bpjs, mt_master_tarif_detail_bedah_1.bill_rs_bpjs, 
                      mt_master_tarif_detail_bedah_1.bill_dr2_bpjs, mt_master_tarif_detail_bedah_1.total_bpjs, mt_master_tarif_detail_bedah_1.bill_rs_nayaka, mt_master_tarif_detail_bedah_1.bill_dr1_nayaka, 
                      mt_master_tarif_detail_bedah_1.bill_dr2_nayaka, mt_master_tarif_detail_bedah_1.total_nayaka, mt_master_tarif_detail_bedah_1.bill_rs_hardlent, 
                      mt_master_tarif_detail_bedah_1.bill_dr1_hardlent, mt_master_tarif_detail_bedah_1.bill_dr2_hardlent, mt_master_tarif_detail_bedah_1.total_hardlent, 
                      mt_master_tarif_detail_bedah_1.bill_rs_inhealth, mt_master_tarif_detail_bedah_1.bill_dr1_inhealth, mt_master_tarif_detail_bedah_1.bill_dr2_inhealth, 
                      mt_master_tarif_detail_bedah_1.total_inhealth1, mt_master_tarif_detail_bedah_1.bill_rs_cahaya, mt_master_tarif_detail_bedah_1.bill_dr1_cahaya, 
                      mt_master_tarif_detail_bedah_1.bill_dr2_cahaya, mt_master_tarif_detail_bedah_1.total_cahaya, mt_master_tarif_detail_bedah_1.kode_tarif_lev4, mt_master_tarif_detail_bedah_1.bill_rs_kapitasi, 
                      mt_master_tarif_detail_bedah_1.bill_dr1_kapitasi, mt_master_tarif_detail_bedah_1.bill_dr2_kapitasi, mt_master_tarif_detail_bedah_1.total_kapitasi, dbo.bedah_upload_v.referensi
FROM         dbo.bedah_upload_v LEFT OUTER JOIN
                      dbo.mt_master_tarif_detail_bedah AS mt_master_tarif_detail_bedah_1 ON dbo.bedah_upload_v.referensi = mt_master_tarif_detail_bedah_1.kode_tarif_lev4 LEFT OUTER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.bedah_upload_v.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif
WHERE     (dbo.mt_master_tarif_detail_bedah.kode_tarif IS NULL)
ORDER BY dbo.bedah_upload_v.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upload_lagi_bedah_v]");
    }
};
