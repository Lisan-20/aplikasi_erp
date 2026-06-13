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
        DB::statement("CREATE VIEW dbo.mt_diet_v
AS
SELECT     dbo.mt_diet.nama_diet, dbo.mt_diet.kode_diet, dbo.mt_kel_diet.nm_kel_diet, dbo.mt_diet.id_mt_diet, dbo.mt_diet.kode_kel
FROM         dbo.mt_diet INNER JOIN
                      dbo.mt_kel_diet ON dbo.mt_diet.kode_kel = dbo.mt_kel_diet.kode_kel
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_diet_v]");
    }
};
