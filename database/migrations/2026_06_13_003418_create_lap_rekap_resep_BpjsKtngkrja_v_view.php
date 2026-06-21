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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_resep_BpjsKtngkrja_v
AS
SELECT     jumlah AS BpjsKtngkrja, tgl, bln, thn, nasabah, kode_profit
FROM         dbo.lap_rekap_resep_v
WHERE     (nasabah = 8) AND (kode_profit = 2000)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_BpjsKtngkrja_v]");
    }
};
