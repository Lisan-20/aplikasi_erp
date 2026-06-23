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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_brg_nm_v
AS
SELECT     dbo.mt_supplier.kodesupplier, dbo.mt_supplier.namasupplier, dbo.tc_penerimaan_barang_nm.no_po, dbo.tc_penerimaan_barang_nm.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang_nm.kode_penerimaan, dbo.tc_penerimaan_barang_nm_detail.kode_brg, dbo.mt_barang_jasa.nama_brg, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_pesan, dbo.tc_penerimaan_barang_nm_detail.satuan, dbo.tc_penerimaan_barang_nm_detail.harga
FROM         dbo.tc_penerimaan_barang_nm_detail INNER JOIN
                      dbo.mt_supplier INNER JOIN
                      dbo.tc_penerimaan_barang_nm ON dbo.mt_supplier.kodesupplier = dbo.tc_penerimaan_barang_nm.kodesupplier ON 
                      dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan = dbo.tc_penerimaan_barang_nm.kode_penerimaan INNER JOIN
                      dbo.mt_barang_jasa ON dbo.tc_penerimaan_barang_nm_detail.kode_brg = dbo.mt_barang_jasa.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_brg_nm_v]");
    }
};
