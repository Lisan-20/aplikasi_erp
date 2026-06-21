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
        DB::statement("CREATE OR ALTER VIEW dbo.plafon_fee_bedah_bpjs_v
AS
SELECT        dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bedah.kode_klas, 
                         SUM(dbo.mt_master_tarif_detail_bedah.bill_rs) AS bill_rs, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr1) AS bill_dr1, 
                         SUM(dbo.mt_master_tarif_detail_bedah.bill_dr2) AS bill_dr2, SUM(dbo.mt_master_tarif_detail_bedah.total) AS total, 
                         SUM(dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs) AS bill_dr1_bpjs, SUM(dbo.mt_master_tarif_detail_bedah.bill_dr2_bpjs) AS bill_dr2_bpjs, 
                         SUM(dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs) AS bill_rs_bpjs, SUM(dbo.mt_master_tarif_detail_bedah.total_bpjs) AS total_bpjs, 
                         dbo.mt_master_tarif.kode_bagian
FROM            dbo.mt_master_tarif_detail_bedah INNER JOIN
                         dbo.mt_master_tarif ON dbo.mt_master_tarif_detail_bedah.kode_tarif = dbo.mt_master_tarif.kode_tarif
GROUP BY dbo.mt_master_tarif_detail_bedah.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_bedah.kode_klas, 
                         dbo.mt_master_tarif.kode_bagian
HAVING        (dbo.mt_master_tarif_detail_bedah.kode_klas = 7)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [plafon_fee_bedah_bpjs_v]");
    }
};
