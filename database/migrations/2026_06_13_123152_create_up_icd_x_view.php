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
        DB::statement("CREATE VIEW dbo.up_icd_x
AS
SELECT     dbo.mt_master_icd10.field14, dbo.mt_master_icd10.icd_10_ok, dbo.ok_x.icd_10_ok AS icd_10_ok_up
FROM         dbo.mt_master_icd10 INNER JOIN
                      dbo.ok_x ON dbo.mt_master_icd10.field14 = dbo.ok_x.field14
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_icd_x]");
    }
};
