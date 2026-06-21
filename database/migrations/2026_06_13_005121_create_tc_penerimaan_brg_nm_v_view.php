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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_penerimaan_brg_nm_v
AS
SELECT     TOP (100) PERCENT dbo.tc_penerimaan_barang_nm_detail.kode_brg, dbo.tc_penerimaan_barang_nm.kode_penerimaan, dbo.tc_penerimaan_barang_nm_detail.id_tc_po_det, 
                      dbo.tc_penerimaan_barang_nm_detail.jumlah_kirim, dbo.tc_penerimaan_barang_nm_detail.[content], dbo.tc_penerimaan_barang_nm_detail.jumlah_pesan, 
                      dbo.tc_penerimaan_barang_nm.diketahui, dbo.tc_penerimaan_barang_nm.dikirim, dbo.tc_penerimaan_barang_nm.disetujui, dbo.tc_penerimaan_barang_nm.petugas, 
                      dbo.tc_penerimaan_barang_nm.id_trans_umd, dbo.mt_barang_nm.nama_brg, dbo.tc_penerimaan_barang_nm_detail.satuan, dbo.tc_penerimaan_barang_nm.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang_nm.no_po, dbo.tc_penerimaan_barang_nm.kodesupplier
FROM         dbo.tc_penerimaan_barang_nm INNER JOIN
                      dbo.tc_penerimaan_barang_nm_detail ON dbo.tc_penerimaan_barang_nm.kode_penerimaan = dbo.tc_penerimaan_barang_nm_detail.kode_penerimaan INNER JOIN
                      dbo.mt_barang_nm ON dbo.tc_penerimaan_barang_nm_detail.kode_brg = dbo.mt_barang_nm.kode_brg
ORDER BY dbo.tc_penerimaan_barang_nm_detail.id_tc_po_det
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penerimaan_brg_nm_v]");
    }
};
