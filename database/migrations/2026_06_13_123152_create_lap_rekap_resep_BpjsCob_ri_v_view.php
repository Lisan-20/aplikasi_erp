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
        DB::statement("CREATE VIEW dbo.lap_rekap_resep_BpjsCob_ri_v
AS
SELECT     jumlah AS BpjsCob, tgl, bln, thn, nasabah, kode_profit
FROM         dbo.lap_rekap_resep_v
WHERE     (nasabah = 11) AND (kode_profit = 1000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_BpjsCob_ri_v]");
    }
};
