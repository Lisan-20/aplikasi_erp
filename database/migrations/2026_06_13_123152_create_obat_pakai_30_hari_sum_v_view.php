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
        DB::statement("CREATE VIEW dbo.obat_pakai_30_hari_sum_v
AS
SELECT     TOP (100) PERCENT kode_barang, SUM(jumlah) AS jumlah, bln, thn
FROM         dbo.obat_pakai_30_hari_v
GROUP BY kode_barang, bln, thn
ORDER BY bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_pakai_30_hari_sum_v]");
    }
};
