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
        DB::statement("CREATE VIEW dbo.jurnal_pen_brg_nonmedis_v
AS
SELECT     dbo.penerimaan_barang_nm_v.kode_penerimaan, dbo.penerimaan_barang_nm_v.no_po, dbo.penerimaan_barang_nm_v.tgl_penerimaan, 
                      dbo.penerimaan_barang_nm_v.jumlah_kirim, dbo.penerimaan_barang_nm_v.total_jumlah_semua, dbo.penerimaan_barang_nm_v.namasupplier, 
                      dbo.penerimaan_barang_nm_v.discount, dbo.penerimaan_barang_nm_v.harga_satuan, dbo.penerimaan_barang_nm_v.jumlah_harga_netto, 
                      dbo.penerimaan_barang_nm_v.total_jumlah AS harga, dbo.penerimaan_barang_nm_v.petugas, dbo.penerimaan_barang_nm_v.kode_brg, 
                      dbo.penerimaan_barang_nm_v.kodesupplier, dbo.penerimaan_barang_nm_v.nama_brg, dbo.penerimaan_barang_nm_v.tgl_ver, 
                      dbo.penerimaan_barang_nm_v.status_ver, dbo.penerimaan_barang_nm_v.kode_detail_penerimaan_barang, dbo.mapping_transaksi_rs_v.kode_proses, 
                      dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.kode_bagian, 
                      dbo.mapping_transaksi_rs_v.nama_bagian
FROM         dbo.penerimaan_barang_nm_v CROSS JOIN
                      dbo.mapping_transaksi_rs_v
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 3) AND (dbo.mapping_transaksi_rs_v.kode_jenis_proses = 22)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pen_brg_nonmedis_v]");
    }
};
