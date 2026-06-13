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
        DB::statement("CREATE VIEW dbo.stok_obat_pakai_30_hari_sum_v
AS
SELECT     kode_brg, SUM(awal) AS awal, SUM(masuk) AS masuk, SUM(jumlah) AS jumlah, stok, thn, bln, kode_bagian
FROM         dbo.stok_obat_pakai_30_hari_v
GROUP BY kode_brg, stok, thn, bln, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_obat_pakai_30_hari_sum_v]");
    }
};
