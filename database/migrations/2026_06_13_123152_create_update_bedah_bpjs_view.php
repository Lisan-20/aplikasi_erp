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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bedah_again
AS
SELECT     TOP (100) PERCENT dbo.bpjs_bedah_insyaallah.kode_tarif, dbo.bpjs_bedah_insyaallah.kode_klas, dbo.bpjs_bedah_insyaallah.bill_dr1_bpjs, dbo.bpjs_bedah_insyaallah.bill_dr2_bpjs, 
                      dbo.bpjs_bedah_insyaallah.bill_rs_bpjs, dbo.bpjs_bedah_insyaallah.total_bpjs, dbo.bpjs_bedah_insyaallah.no_urut, dbo.bpjs_bedah_insyaallah.referensi, 
                      dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs AS bill_dr1_bpjs_mt, dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs AS bill_dr2_bpjs_mt, 
                      dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs AS bill_rs_bpjs_mt, dbo.mt_master_tarif_detail_bedah.total_bpjs AS total_bpjs_mt
FROM         dbo.bpjs_bedah_insyaallah INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.bpjs_bedah_insyaallah.referensi = dbo.mt_master_tarif_detail_bedah.kode_tarif_lev4
ORDER BY dbo.bpjs_bedah_insyaallah.no_urut, dbo.bpjs_bedah_insyaallah.kode_klas, dbo.bpjs_bedah_insyaallah.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bedah_bpjs]");
    }
};
