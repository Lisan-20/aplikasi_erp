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
        DB::statement("CREATE VIEW dbo.lap_rekap_resep_BpjsPbi_ri_v
AS
SELECT     jumlah AS BpjsPbi, tgl, bln, thn, nasabah, kode_profit
FROM         dbo.lap_rekap_resep_v
WHERE     (nasabah = 9) AND (kode_profit = 1000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_BpjsPbi_ri_v]");
    }
};
