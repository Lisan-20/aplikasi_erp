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
        DB::statement("CREATE OR ALTER VIEW dbo.RI_nonKecelakaan_v
AS
SELECT     jmlpas, tglmasuk AS tgl, blnmasuk AS bln, thnmasuk AS thn, stat_celaka
FROM         dbo.pulang_secara_RI_v
WHERE     (stat_celaka IS NULL) OR
                      (stat_celaka = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [RI_nonKecelakaan_v]");
    }
};
