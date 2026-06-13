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
        DB::statement("CREATE VIEW dbo.RJ_kecelakaan_v
AS
SELECT     jmlpas, tglmasuk AS tgl, blnmasuk AS bln, thnmasuk AS thn, stat_celaka
FROM         dbo.pulang_secara_RJ_v
WHERE     (stat_celaka = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [RJ_kecelakaan_v]");
    }
};
