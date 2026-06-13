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
        DB::statement("CREATE VIEW dbo.depo_kurang_v
AS
SELECT     COUNT(kode_brg) AS kode_brg, kode_bagian
FROM         dbo.mt_depo_stok
WHERE     (jml_sat_kcl < stok_minimum)
GROUP BY kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [depo_kurang_v]");
    }
};
