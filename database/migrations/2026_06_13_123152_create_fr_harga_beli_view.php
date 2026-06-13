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
        DB::statement("
CREATE VIEW dbo.fr_harga_beli
AS
SELECT     dbo.mt_barang.*, dbo.mt_rekap_stok.harga_beli AS Expr1, dbo.mt_rekap_stok.harga_persediaan AS Expr2
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_rekap_stok.kode_brg = dbo.mt_barang.kode_brg

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_harga_beli]");
    }
};
