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
        DB::statement("CREATE VIEW dbo.tc_penerimaan_rekanan_v
AS
SELECT     dbo.tc_permintaan_rekanan.nomor_permintaan, dbo.tc_permintaan_rekanan.nomor_pengiriman, dbo.tc_permintaan_rekanan.tgl_permintaan, 
                      dbo.tc_permintaan_rekanan.kode_perusahaan, dbo.tc_permintaan_rekanan.kode_bagian_kirim, dbo.tc_penerimaan_rekanan.id_tc_penerimaan_rekanan, 
                      dbo.tc_penerimaan_rekanan.tgl_terima, dbo.tc_penerimaan_rekanan.yg_serah, dbo.tc_penerimaan_rekanan.id_dd_user, dbo.tc_penerimaan_rekanan.selesai, 
                      dbo.tc_penerimaan_rekanan_detail.kode_brg, dbo.tc_penerimaan_rekanan_detail.jumlah, dbo.tc_penerimaan_rekanan_detail.id_tc_permintaan_rekanan, 
                      dbo.tc_penerimaan_rekanan_detail.petugas, dbo.mt_barang.nama_brg, dbo.tc_permintaan_rekanan_det.jumlah_permintaan, dbo.mt_barang.satuan_kecil, 
                      dbo.tc_penerimaan_rekanan.yg_terima
FROM         dbo.tc_penerimaan_rekanan_detail INNER JOIN
                      dbo.tc_permintaan_rekanan ON dbo.tc_penerimaan_rekanan_detail.id_tc_permintaan_rekanan = dbo.tc_permintaan_rekanan.id_tc_permintaan_rekanan INNER JOIN
                      dbo.tc_penerimaan_rekanan ON dbo.tc_penerimaan_rekanan_detail.id_tc_penerimaan_rekanan = dbo.tc_penerimaan_rekanan.id_tc_penerimaan_rekanan INNER JOIN
                      dbo.mt_barang ON dbo.tc_penerimaan_rekanan_detail.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_permintaan_rekanan_det ON dbo.mt_barang.kode_brg = dbo.tc_permintaan_rekanan_det.kode_brg AND 
                      dbo.tc_penerimaan_rekanan_detail.id_tc_permintaan_rekanan = dbo.tc_permintaan_rekanan_det.id_tc_permintaan_rekanan
GROUP BY dbo.tc_permintaan_rekanan.nomor_permintaan, dbo.tc_permintaan_rekanan.nomor_pengiriman, dbo.tc_permintaan_rekanan.tgl_permintaan, 
                      dbo.tc_permintaan_rekanan.kode_perusahaan, dbo.tc_permintaan_rekanan.kode_bagian_kirim, dbo.tc_penerimaan_rekanan.id_tc_penerimaan_rekanan, 
                      dbo.tc_penerimaan_rekanan.tgl_terima, dbo.tc_penerimaan_rekanan.yg_terima, dbo.tc_penerimaan_rekanan.yg_serah, dbo.tc_penerimaan_rekanan.id_dd_user, 
                      dbo.tc_penerimaan_rekanan.selesai, dbo.tc_penerimaan_rekanan_detail.kode_brg, dbo.tc_penerimaan_rekanan_detail.jumlah, 
                      dbo.tc_penerimaan_rekanan_detail.id_tc_permintaan_rekanan, dbo.tc_penerimaan_rekanan_detail.petugas, dbo.mt_barang.nama_brg, 
                      dbo.tc_permintaan_rekanan_det.jumlah_permintaan, dbo.mt_barang.satuan_kecil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_penerimaan_rekanan_v]");
    }
};
