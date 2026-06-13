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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_pengiriman_unit_nm_kredit_v
AS
SELECT     TOP (100) PERCENT dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst, dbo.tc_permintaan_inst_nm.nomor_permintaan, dbo.tc_permintaan_inst_nm.tgl_permintaan, 
                      dbo.tc_permintaan_inst_nm.kode_bagian_minta, dbo.tc_permintaan_inst_nm.kode_bagian_kirim, dbo.tc_permintaan_inst_nm.id_dd_user, dbo.tc_permintaan_inst_nm_det.jumlah_permintaan, 
                      dbo.tc_permintaan_inst_nm_det.kode_brg, dbo.mt_barang_nm.nama_brg, dbo.tc_permintaan_inst_nm_det.satuan, dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan, 
                      dbo.tc_permintaan_inst_nm_det.tgl_ver, dbo.tc_permintaan_inst_nm_det.status_ver, dbo.tc_permintaan_inst_nm_det.tgl_kirim, dbo.mt_bagian.nama_bagian, dbo.tc_permintaan_inst_nm.yg_terima, 
                      dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst_det AS no_jurnal, dbo.mapping_transaksi_rs_v.kode_proses, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.mapping_transaksi_rs_v.nama_kredit, dbo.mt_rekap_stok_nm.harga_beli, dbo.mt_rekap_stok_nm.kode_bagian_gudang, 
                      dbo.mt_rekap_stok_nm.harga_beli * dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan AS harga, dbo.mt_barang_nm.kode_golongan
FROM         dbo.mapping_transaksi_rs_v INNER JOIN
                      dbo.mt_bagian INNER JOIN
                      dbo.tc_permintaan_inst_nm ON dbo.mt_bagian.kode_bagian = dbo.tc_permintaan_inst_nm.kode_bagian_minta INNER JOIN
                      dbo.mt_rekap_stok_nm INNER JOIN
                      dbo.mt_barang_nm INNER JOIN
                      dbo.tc_permintaan_inst_nm_det ON dbo.mt_barang_nm.kode_brg = dbo.tc_permintaan_inst_nm_det.kode_brg ON dbo.mt_rekap_stok_nm.kode_brg = dbo.tc_permintaan_inst_nm_det.kode_brg ON 
                      dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst = dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst ON 
                      dbo.mapping_transaksi_rs_v.kode_bagian = dbo.tc_permintaan_inst_nm.kode_bagian_kirim
GROUP BY dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst, dbo.tc_permintaan_inst_nm.nomor_permintaan, dbo.tc_permintaan_inst_nm.tgl_permintaan, dbo.tc_permintaan_inst_nm.kode_bagian_minta, 
                      dbo.tc_permintaan_inst_nm.kode_bagian_kirim, dbo.tc_permintaan_inst_nm.id_dd_user, dbo.tc_permintaan_inst_nm_det.jumlah_permintaan, dbo.tc_permintaan_inst_nm_det.kode_brg, 
                      dbo.mt_barang_nm.nama_brg, dbo.tc_permintaan_inst_nm_det.satuan, dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan, dbo.tc_permintaan_inst_nm_det.tgl_ver, 
                      dbo.tc_permintaan_inst_nm_det.status_ver, dbo.tc_permintaan_inst_nm_det.tgl_kirim, dbo.mt_bagian.nama_bagian, dbo.tc_permintaan_inst_nm.yg_terima, 
                      dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst_det, dbo.mapping_transaksi_rs_v.kode_proses, dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_kredit, 
                      dbo.mt_rekap_stok_nm.harga_beli, dbo.mt_rekap_stok_nm.kode_bagian_gudang, dbo.mt_rekap_stok_nm.harga_beli * dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan, 
                      dbo.mt_barang_nm.kode_golongan
HAVING      (dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan > 0) AND (dbo.mapping_transaksi_rs_v.kode_proses = 13) AND (dbo.mt_rekap_stok_nm.kode_bagian_gudang = '070101') AND 
                      (dbo.mapping_transaksi_rs_v.acc_kredit > N'0') AND (dbo.mt_rekap_stok_nm.harga_beli * dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan > 0) AND (dbo.mt_barang_nm.kode_golongan = 'F01')
ORDER BY dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pengiriman_unit_nm_kredit_v]");
    }
};
