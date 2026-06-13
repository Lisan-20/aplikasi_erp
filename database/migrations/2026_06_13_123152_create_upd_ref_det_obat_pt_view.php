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
        DB::statement("CREATE VIEW dbo.upd_ref_det_obat_pt
AS
SELECT     dbo.barang_aktif_pt.kode_produk, dbo.mt_barang.barcode AS ref_kd_brg, dbo.barang_aktif_pt.nama_produk, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_besar, 
                      dbo.mt_barang.[content] AS rasio, dbo.barang_aktif_pt.harga_pokok AS harga_satuan_netto, dbo.mt_barang.kode_brg
FROM         dbo.barang_aktif_pt INNER JOIN
                      dbo.mt_barang ON dbo.barang_aktif_pt.kode_produk = dbo.mt_barang.barcode
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_ref_det_obat_pt]");
    }
};
