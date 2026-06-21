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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_tukar_faktur_nm_v
AS
SELECT        dbo.mt_supplier.kodesupplier, dbo.mt_supplier.namasupplier, dbo.tc_penerimaan_barang_nm.kode_penerimaan, dbo.tc_penerimaan_barang_nm.no_po, dbo.tc_penerimaan_barang_nm.tgl_penerimaan, 
                         dbo.tc_penerimaan_barang_nm.petugas, dbo.tc_penerimaan_barang_nm.tipe_lpb, dbo.tc_penerimaan_barang_nm.keterangan, dbo.tc_penerimaan_barang_nm.no_faktur, 
                         dbo.tc_penerimaan_barang_nm.diketahui, dbo.tc_penerimaan_barang_nm.dikirim, dbo.tc_penerimaan_barang_nm.disetujui, dbo.tc_penerimaan_barang_nm.status_invoice, 
                         dbo.tc_penerimaan_barang_nm.flag_hutang, dbo.tc_penerimaan_barang_nm.id_trans_umd
FROM            dbo.mt_supplier INNER JOIN
                         dbo.tc_penerimaan_barang_nm ON dbo.mt_supplier.kodesupplier = dbo.tc_penerimaan_barang_nm.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_tukar_faktur_nm_v]");
    }
};
