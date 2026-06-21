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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_nota_debet_v
AS
SELECT     SUM(jumlah) AS ND, no_registrasi
FROM         dbo.tran_kasir
WHERE     (seri_kuitansi NOT IN ('RJ', 'AJ')) AND (kode = 4)
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_nota_debet_v]");
    }
};
