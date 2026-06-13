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
        DB::statement("CREATE VIEW dbo.rekap_stok_man_v
AS
SELECT     kode AS kode_brg, harga_ppn AS harga_beli, harga_ppn AS harga_persediaan, '060201' AS kode_bagian_gudang
FROM         dbo.obat_lagi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_stok_man_v]");
    }
};
