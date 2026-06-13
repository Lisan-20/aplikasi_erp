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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_diskon_RI
AS
SELECT     SUM(tx_nominal) AS diskon, no_registrasi
FROM         dbo.trans_sed_v
WHERE     (seri_kuitansi IN ('AI', 'RI')) AND (kode IN (20, 21, 22, 23, 24, 25, 26))
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_diskon_RI]");
    }
};
