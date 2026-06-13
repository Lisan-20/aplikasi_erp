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
        DB::statement("CREATE VIEW dbo.referensi_man_v
AS
SELECT     TOP (100) PERCENT dbo.suplier_lama.suplier, dbo.suplier_lama.kode_sup, dbo.mt_supplier.namasupplier, '/REF/03/2015' AS ref, 
                      dbo.mt_supplier.kodesupplier,ROW_NUMBER() OVER (ORDER BY kodesupplier) AS RowNumber FROM         dbo.suplier_lama INNER JOIN
                      dbo.obat_gudang_lm ON dbo.suplier_lama.kode_sup = dbo.obat_gudang_lm.suplier INNER JOIN
                      dbo.mt_barang ON dbo.obat_gudang_lm.nama_brg = dbo.mt_barang.nama_brg INNER JOIN
                      dbo.mt_supplier ON dbo.suplier_lama.kode_sup = dbo.mt_supplier.pola_supplier
GROUP BY dbo.suplier_lama.suplier, dbo.suplier_lama.kode_sup, dbo.mt_supplier.namasupplier, dbo.mt_supplier.kodesupplier
ORDER BY RowNumber,dbo.mt_supplier.namasupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [referensi_man_v]");
    }
};
