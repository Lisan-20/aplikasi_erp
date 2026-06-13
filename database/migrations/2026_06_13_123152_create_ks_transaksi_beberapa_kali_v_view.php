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
        DB::statement("CREATE OR ALTER VIEW dbo.ks_transaksi_beberapa_kali
AS
SELECT     TOP 100 PERCENT no_registrasi
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_tc_trans_kasir IS NOT NULL) AND (no_registrasi <> 0)
GROUP BY no_registrasi
HAVING      (AVG(kode_tc_trans_kasir) <> MAX(kode_tc_trans_kasir))
ORDER BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ks_transaksi_beberapa_kali_v]");
    }
};
