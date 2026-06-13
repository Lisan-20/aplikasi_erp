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
        DB::statement("CREATE VIEW dbo.upd_bedah_lagi_v
AS
SELECT     dbo.bpjs_bedah_newbie.kode_klas, dbo.bpjs_bedah_newbie.referensi, dbo.bpjs_bedah_newbie.detail, dbo.bpjs_bedah_newbie.no_urut, 
                      dbo.bpjs_bedah_newbie.bill_dr1_bpjs, dbo.bpjs_bedah_newbie.bill_dr2_bpjs, dbo.bpjs_bedah_newbie.bill_rs_bpjs, dbo.bpjs_bedah_newbie.total_bpjs, 
                      dbo.mt_master_tarif_detail_bedah_cek.bill_dr1_bpjs AS bill_dr1_bpjs_cek, dbo.mt_master_tarif_detail_bedah_cek.bill_dr2_bpjs AS bill_dr2_bpjs_cek, 
                      dbo.mt_master_tarif_detail_bedah_cek.bill_rs_bpjs AS bill_rs_bpjs_cek, dbo.mt_master_tarif_detail_bedah_cek.total_bpjs AS total_bpjs_cek
FROM         dbo.bpjs_bedah_newbie LEFT OUTER JOIN
                      dbo.mt_master_tarif_detail_bedah_cek ON dbo.bpjs_bedah_newbie.referensi = dbo.mt_master_tarif_detail_bedah_cek.kode_tarif_lev4
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bedah_lagi_v]");
    }
};
