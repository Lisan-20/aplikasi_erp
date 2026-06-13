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
        DB::statement("CREATE VIEW dbo.tc_penerimaan_brg_v
AS
SELECT     dbo.tc_penerimaan_barang.kode_penerimaan, dbo.tc_penerimaan_barang_detail.kode_brg, dbo.tc_penerimaan_barang.tgl_penerimaan, 
                      dbo.tc_penerimaan_barang.kodesupplier, dbo.tc_penerimaan_barang.petugas, dbo.tc_penerimaan_barang.no_faktur, dbo.tc_penerimaan_barang.dikirim, 
                      dbo.tc_penerimaan_barang_detail.jumlah_pesan, dbo.tc_penerimaan_barang_detail.jumlah_kirim, dbo.tc_penerimaan_barang_detail.bonus_pesan, 
                      dbo.tc_penerimaan_barang_detail.bonus_kirim, dbo.tc_penerimaan_barang_detail.bonus_kurang, dbo.tc_penerimaan_barang_detail.[content], 
                      dbo.tc_penerimaan_barang_detail.keterangan, dbo.tc_penerimaan_barang_detail.tgl_kadaluarsa, dbo.tc_penerimaan_barang_detail.harga_satuan, 
                      dbo.tc_penerimaan_barang_detail.harga_total, dbo.tc_penerimaan_barang_detail.harga_satuan_netto, dbo.tc_penerimaan_barang_detail.jumlah_harga_netto, 
                      dbo.tc_penerimaan_barang_detail.satuan, dbo.tc_penerimaan_barang_detail.kode_detail_penerimaan_barang
FROM         dbo.tc_penerimaan_barang INNER JOIN
                      dbo.tc_penerimaan_barang_detail ON dbo.tc_penerimaan_barang.kode_penerimaan = dbo.tc_penerimaan_barang_detail.kode_penerimaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penerimaan_brg_v]");
    }
};
