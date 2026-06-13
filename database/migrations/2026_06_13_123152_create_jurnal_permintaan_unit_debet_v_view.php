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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_permintaan_unit_debet_v
AS
SELECT     TOP (100) PERCENT dbo.tc_permintaan_inst.id_tc_permintaan_inst, dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, 
                      dbo.tc_permintaan_inst.kode_bagian_minta, dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.id_dd_user, 
                      dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_permintaan_inst_det.satuan, 
                      dbo.tc_permintaan_inst_det.jumlah_penerimaan, dbo.tc_permintaan_inst_det.tgl_ver, dbo.tc_permintaan_inst_det.status_ver, dbo.tc_permintaan_inst_det.tgl_kirim, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_permintaan_inst.yg_terima, dbo.tc_permintaan_inst_det.id_tc_permintaan_inst_det AS no_jurnal, 
                      dbo.mapping_transaksi_rs_v.kode_proses, dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.nama_debet, dbo.mt_rekap_stok.harga_beli, 
                      dbo.mt_rekap_stok.kode_bagian_gudang, dbo.mt_rekap_stok.harga_beli * dbo.tc_permintaan_inst_det.jumlah_penerimaan AS harga
FROM         dbo.tc_permintaan_inst INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mapping_transaksi_rs_v.kode_bagian INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_rekap_stok.kode_brg
GROUP BY dbo.tc_permintaan_inst.id_tc_permintaan_inst, dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, 
                      dbo.tc_permintaan_inst.kode_bagian_minta, dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.id_dd_user, 
                      dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_permintaan_inst_det.satuan, 
                      dbo.tc_permintaan_inst_det.jumlah_penerimaan, dbo.tc_permintaan_inst_det.tgl_ver, dbo.tc_permintaan_inst_det.status_ver, dbo.tc_permintaan_inst_det.tgl_kirim, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_permintaan_inst.yg_terima, dbo.tc_permintaan_inst_det.id_tc_permintaan_inst_det, dbo.mapping_transaksi_rs_v.kode_proses, 
                      dbo.mapping_transaksi_rs_v.acc_debet, dbo.mapping_transaksi_rs_v.nama_debet, dbo.mt_rekap_stok.harga_beli, dbo.mt_rekap_stok.kode_bagian_gudang, 
                      dbo.mt_rekap_stok.harga_beli * dbo.tc_permintaan_inst_det.jumlah_penerimaan
HAVING      (dbo.tc_permintaan_inst_det.jumlah_penerimaan > 0) AND (dbo.mapping_transaksi_rs_v.kode_proses = 6) AND (dbo.mapping_transaksi_rs_v.acc_debet > N'0') AND 
                      (dbo.mt_rekap_stok.kode_bagian_gudang = '060201')
ORDER BY dbo.tc_permintaan_inst.id_tc_permintaan_inst
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_permintaan_unit_debet_v]");
    }
};
