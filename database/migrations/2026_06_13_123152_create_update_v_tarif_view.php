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
        DB::statement("CREATE VIEW dbo.update_v_tarif
AS
SELECT     medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.bill_dr1, medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.bill_rs, medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.bill_rs_bpjs, 
                      medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.total_bpjs, mt_master_tarif_detail_bedah_1.bill_rs AS Expr1, mt_master_tarif_detail_bedah_1.bill_dr1 AS Expr2, 
                      mt_master_tarif_detail_bedah_1.bill_rs_bpjs AS Expr3, mt_master_tarif_detail_bedah_1.total_bpjs AS Expr4, mt_master_tarif_detail_bedah_1.kode_tarif, 
                      medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.total, mt_master_tarif_detail_bedah_1.total AS Expr5, medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.bill_dr1_bpjs, 
                      mt_master_tarif_detail_bedah_1.bill_dr1_bpjs AS Expr6
FROM         medi2cbr_bak.dbo.mt_master_tarif_detail_bedah INNER JOIN
                      dbo.mt_master_tarif_detail_bedah AS mt_master_tarif_detail_bedah_1 ON medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.kode_klas = mt_master_tarif_detail_bedah_1.kode_klas AND 
                      medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.no_urut = mt_master_tarif_detail_bedah_1.no_urut AND 
                      medi2cbr_bak.dbo.mt_master_tarif_detail_bedah.kode_tarif = mt_master_tarif_detail_bedah_1.kode_tarif
WHERE     (mt_master_tarif_detail_bedah_1.kode_tarif = 309080204)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_v_tarif]");
    }
};
