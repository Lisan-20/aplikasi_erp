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
        DB::statement("CREATE VIEW dbo.TOTAL_PENDAPATAN_UM_V
AS
SELECT     SUM(tunai) AS um, no_registrasi
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL) AND (seri_kuitansi = 'UM')
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [TOTAL_PENDAPATAN_UM_V]");
    }
};
