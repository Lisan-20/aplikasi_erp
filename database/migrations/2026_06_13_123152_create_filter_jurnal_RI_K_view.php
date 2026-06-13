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
        DB::statement("CREATE VIEW dbo.filter_jurnal_RI_K
AS
SELECT     SUM(tx_nominal) AS K, no_registrasi
FROM         dbo.trans_sed_v
WHERE     (seri_kuitansi IN ('AI', 'RI')) AND (kode NOT IN (20, 21, 22, 23, 24, 25, 26))
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_RI_K]");
    }
};
