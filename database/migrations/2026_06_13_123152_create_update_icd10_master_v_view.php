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
        DB::statement("CREATE VIEW dbo.update_icd10_master_v
AS
SELECT     dbo.mt_master_icd10_inacbgs.icd_x, dbo.mt_master_icd10_inacbgs.icd_x_ok, dbo.mt_master_icd10_inacbgs.diagnosa, dbo.mt_master_icd10_inacbgs.grup, 
                      dbo.mt_master_icd10_inacbgs.urut, dbo.mt_master_icd10.icd_10_ok
FROM         dbo.mt_master_icd10_inacbgs INNER JOIN
                      dbo.mt_master_icd10 ON dbo.mt_master_icd10_inacbgs.icd_x = dbo.mt_master_icd10.icd_10
WHERE     (NOT (dbo.mt_master_icd10_inacbgs.icd_x_ok IN
                          (SELECT     icd_10_ok
                            FROM          dbo.mt_master_icd10 AS mt_master_icd10_1
                            WHERE      (icd_10_ok IS NOT NULL)))) AND (dbo.mt_master_icd10.icd_10_ok IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_icd10_master_v]");
    }
};
