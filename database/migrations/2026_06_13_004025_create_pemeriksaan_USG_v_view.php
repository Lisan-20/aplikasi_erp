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
        DB::statement("CREATE OR ALTER VIEW dbo.pemeriksaan_USG_v
AS
SELECT     nama_tarif, kode_tarif
FROM         dbo.mt_master_tarif
WHERE     (nama_tarif LIKE '%USG Kebidanan%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pemeriksaan_USG_v]");
    }
};
