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
        DB::statement("CREATE VIEW dbo.content_obat_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.mt_barang.nama_brg, dbo.content_obat.nama_brg AS Expr1, dbo.mt_barang.satuan_besar, dbo.mt_barang.satuan_kecil, 
                      dbo.content_obat.satuan, dbo.mt_barang.[content], dbo.content_obat.[content] AS content_obat
FROM         dbo.mt_barang INNER JOIN
                      dbo.content_obat ON dbo.mt_barang.nama_brg = dbo.content_obat.nama_brg
WHERE     (dbo.content_obat.[content] > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [content_obat_v]");
    }
};
