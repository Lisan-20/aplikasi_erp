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
        DB::statement("CREATE VIEW dbo.ref_man_det_v
AS
SELECT     dbo.mt_barang.kode_brg, dbo.obat_gudang_lm.nama_brg, dbo.obat_gudang_lm.hna, dbo.suplier_lama.suplier, dbo.suplier_lama.kode_sup, 
                      dbo.mt_supplier.namasupplier, dbo.mt_supplier.kodesupplier, dbo.mt_barang.satuan_besar, dbo.mt_barang.[content], 
                      dbo.mt_barang.satuan_kecil
FROM         dbo.suplier_lama INNER JOIN
                      dbo.obat_gudang_lm ON dbo.suplier_lama.kode_sup = dbo.obat_gudang_lm.suplier INNER JOIN
                      dbo.mt_barang ON dbo.obat_gudang_lm.nama_brg = dbo.mt_barang.nama_brg INNER JOIN
                      dbo.mt_supplier ON dbo.suplier_lama.kode_sup = dbo.mt_supplier.pola_supplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_man_det_v]");
    }
};
