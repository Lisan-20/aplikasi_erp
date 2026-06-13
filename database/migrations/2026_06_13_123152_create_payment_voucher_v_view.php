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
CREATE VIEW dbo.payment_voucher_v
AS
SELECT     dbo.tc_hutang_supplier_vcr_det.kode_penerimaan, dbo.tc_penerimaan_barang_detail.jumlah_kirim, dbo.mt_barang.nama_brg, dbo.tc_po_det.ppn, 
                      dbo.tc_po_det.harga_satuan, dbo.tc_po_det.jumlah_harga_netto AS total_harga, dbo.mt_supplier.namasupplier, 
                      dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr, dbo.tc_hutang_supplier_vcr.no_voucher
FROM         dbo.tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_hutang_supplier_vcr_det ON 
                      dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr_det.id_tc_hutang_supplier_vcr INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.tc_hutang_supplier_vcr_det.kode_penerimaan = dbo.tc_penerimaan_barang.kode_penerimaan INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan INNER JOIN
                      dbo.tc_po_det ON dbo.tc_penerimaan_barang_detail.id_tc_po_det = dbo.tc_po_det.id_tc_po_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_po_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_supplier ON dbo.tc_hutang_supplier_vcr.kodesupplier = dbo.mt_supplier.kodesupplier

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [payment_voucher_v]");
    }
};
