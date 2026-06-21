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
        DB::statement("CREATE OR ALTER VIEW dbo.penjulan_obat_kinerja_rs_sum_v
AS
SELECT     SUM(tx_nominal) AS tx_nominal, tipe_jual AS tipe, thn, bln
FROM         dbo.penjualan_obat_kinerja_rs_v
GROUP BY tipe_jual, thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penjulan_obat_kinerja_rs_sum_v]");
    }
};
