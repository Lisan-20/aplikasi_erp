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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_gizi_11_v
AS
SELECT     kode_klas, SUM(biaya_gizi) AS biaya_gizi, kode_kelompok
FROM         dbo.jurnal_gizi_v
GROUP BY kode_klas, kode_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_gizi_11_v]");
    }
};
