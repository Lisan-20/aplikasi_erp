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
        DB::statement("CREATE VIEW dbo.lap_rekap_resep_luar_v
AS
SELECT     SUM(jumlah) AS luar, tgl, bln, thn, kode_profit
FROM         dbo.lap_rekap_resep_v
GROUP BY tgl, bln, thn, kode_profit
HAVING      (kode_profit = 3000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_luar_v]");
    }
};
