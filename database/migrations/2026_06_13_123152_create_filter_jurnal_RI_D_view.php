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
        DB::statement("CREATE VIEW dbo.filter_jurnal_RI_D
AS
SELECT     SUM(jumlah) AS D, no_registrasi
FROM         dbo.tran_kasir
WHERE     (seri_kuitansi NOT IN ('RJ', 'AJ', 'NK')) AND (kode NOT IN (4, 7))
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_RI_D]");
    }
};
