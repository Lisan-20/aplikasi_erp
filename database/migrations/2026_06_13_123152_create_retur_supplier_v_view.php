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
        DB::statement("CREATE VIEW dbo.retur_supplier_v
AS
SELECT     dbo.tc_retur_supplier.tgl AS tgl_return, dbo.tc_retur_supplier.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_retur_supplier.no_po, 
                      dbo.tc_retur_supplier.no_lpb, dbo.tc_retur_supplier.jumlah, dbo.tc_retur_supplier.ket, dbo.mt_supplier.namasupplier, 
                      dbo.tc_penerimaan_barang_detail.satuan, dbo.tc_retur_supplier.user_id, dbo.mt_karyawan.nama_pegawai
FROM         dbo.tc_retur_supplier INNER JOIN
                      dbo.mt_barang ON dbo.tc_retur_supplier.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_supplier ON dbo.tc_retur_supplier.kodesupplier = dbo.mt_supplier.kodesupplier INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON 
                      dbo.tc_retur_supplier.kode_detail_penerimaan_barang = dbo.tc_penerimaan_barang_detail.kode_detail_penerimaan_barang INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_retur_supplier.user_id = dbo.mt_karyawan.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [retur_supplier_v]");
    }
};
