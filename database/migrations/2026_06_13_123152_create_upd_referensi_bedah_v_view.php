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
        DB::statement("CREATE VIEW dbo.upd_referensi_bedah_v
AS
SELECT     dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, dbo.mt_master_tarif_detail_bedah.total_bpjs, 
                      dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif.referensi, dbo.mt_master_tarif_detail_bedah.referensi AS ref
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_bedah ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_bedah.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_referensi_bedah_v]");
    }
};
