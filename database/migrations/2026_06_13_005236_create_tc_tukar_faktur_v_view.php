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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_tukar_faktur_v
AS
SELECT     dbo.mt_supplier.kodesupplier, dbo.mt_supplier.namasupplier, dbo.tc_penerimaan_barang.no_po, dbo.tc_penerimaan_barang.petugas, dbo.tc_penerimaan_barang.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang.no_faktur, dbo.tc_penerimaan_barang.keterangan, dbo.tc_penerimaan_barang.tipe_lpb, dbo.tc_penerimaan_barang.diketahui, dbo.tc_penerimaan_barang.dikirim, 
                      dbo.tc_penerimaan_barang.disetujui, dbo.tc_penerimaan_barang.status_invoice, dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tc_penerimaan_barang.flag_hutang, 
                      dbo.tc_penerimaan_barang.flag_is
FROM         dbo.mt_supplier INNER JOIN
                      dbo.tc_penerimaan_barang ON dbo.mt_supplier.kodesupplier = dbo.tc_penerimaan_barang.kodesupplier
GROUP BY dbo.mt_supplier.kodesupplier, dbo.mt_supplier.namasupplier, dbo.tc_penerimaan_barang.no_po, dbo.tc_penerimaan_barang.petugas, dbo.tc_penerimaan_barang.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang.no_faktur, dbo.tc_penerimaan_barang.keterangan, dbo.tc_penerimaan_barang.tipe_lpb, dbo.tc_penerimaan_barang.diketahui, dbo.tc_penerimaan_barang.dikirim, 
                      dbo.tc_penerimaan_barang.disetujui, dbo.tc_penerimaan_barang.status_invoice, dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tc_penerimaan_barang.flag_hutang, 
                      dbo.tc_penerimaan_barang.flag_is
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_tukar_faktur_v]");
    }
};
