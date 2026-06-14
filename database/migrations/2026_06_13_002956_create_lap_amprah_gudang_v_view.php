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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_amprah_gudang_v
AS
SELECT     dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.kode_bagian_minta, dbo.mt_bagian.nama_bagian AS bagian_minta, dbo.mt_barang.nama_brg, 
                      dbo.tc_permintaan_inst_det.kode_brg, dbo.tc_permintaan_inst_det.satuan, SUM(dbo.tc_permintaan_inst_det.jumlah_permintaan) AS jumlah_permintaan, 
                      SUM(dbo.tc_permintaan_inst_det.jumlah_penerimaan) AS jumlah_penerimaan, dbo.tc_permintaan_inst_det.harga, MONTH(dbo.tc_permintaan_inst.tgl_pengiriman) AS bln, 
                      YEAR(dbo.tc_permintaan_inst.tgl_pengiriman) AS thn, dbo.tc_permintaan_inst.tgl_pengiriman
FROM         dbo.tc_permintaan_inst_det INNER JOIN
                      dbo.tc_permintaan_inst ON dbo.tc_permintaan_inst_det.id_tc_permintaan_inst = dbo.tc_permintaan_inst.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.kode_bagian_minta, dbo.mt_bagian.nama_bagian, dbo.mt_barang.nama_brg, dbo.tc_permintaan_inst_det.kode_brg, 
                      dbo.tc_permintaan_inst_det.satuan, dbo.tc_permintaan_inst_det.harga, MONTH(dbo.tc_permintaan_inst.tgl_pengiriman), YEAR(dbo.tc_permintaan_inst.tgl_pengiriman), 
                      dbo.tc_permintaan_inst.tgl_pengiriman
HAVING      (dbo.tc_permintaan_inst.kode_bagian_kirim = '060201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_amprah_gudang_v]");
    }
};
