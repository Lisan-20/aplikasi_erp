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
        DB::statement("CREATE OR ALTER VIEW dbo.supplier_obat_kurang_v
AS
SELECT        TOP (100) PERCENT COUNT(DISTINCT dbo.mt_depo_stok.kode_brg) AS kode_brg, dbo.mt_supplier.namasupplier, dbo.supplier_ref_v.kodesupplier
FROM            dbo.mt_supplier INNER JOIN
                         dbo.supplier_ref_v ON dbo.mt_supplier.kodesupplier = dbo.supplier_ref_v.kodesupplier INNER JOIN
                         dbo.mt_depo_stok ON dbo.supplier_ref_v.kode_brg = dbo.mt_depo_stok.kode_brg
GROUP BY dbo.mt_supplier.namasupplier, dbo.supplier_ref_v.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [supplier_obat_kurang_v]");
    }
};
