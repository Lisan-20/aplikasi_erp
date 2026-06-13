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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_amprah_gudang_keinhos_v
AS
SELECT     SUM(dbo.tc_permintaan_rekanan_det.jumlah_permintaan) AS jumlah_permintaan, dbo.tc_permintaan_rekanan_det.kode_brg, dbo.tc_permintaan_rekanan_det.satuan, 
                      dbo.tc_permintaan_rekanan_det.penerimaan_brg, SUM(dbo.tc_permintaan_rekanan_det.jumlah_penerimaan) AS jumlah_penerimaan, 
                      dbo.tc_permintaan_rekanan_det.kekurangan, dbo.tc_permintaan_rekanan_det.harga_beli, dbo.tc_permintaan_rekanan_det.harga_jual, 
                      dbo.tc_permintaan_rekanan_det.status_ver, dbo.tc_permintaan_rekanan_det.flag, dbo.tc_permintaan_rekanan.kode_perusahaan, dbo.mt_provider.nama_provider, 
                      dbo.mt_barang.nama_brg, dbo.tc_permintaan_rekanan.id_dd_user, dbo.tc_permintaan_rekanan.id_tc_permintaan_rekanan, 
                      MONTH(dbo.tc_permintaan_rekanan_det.tgl_kirim) AS bln, YEAR(dbo.tc_permintaan_rekanan_det.tgl_kirim) AS thn, dbo.mt_barang.harga_satuan
FROM         dbo.tc_permintaan_rekanan_det INNER JOIN
                      dbo.tc_permintaan_rekanan ON dbo.tc_permintaan_rekanan_det.id_tc_permintaan_rekanan = dbo.tc_permintaan_rekanan.id_tc_permintaan_rekanan INNER JOIN
                      dbo.mt_provider ON dbo.tc_permintaan_rekanan.kode_perusahaan = dbo.mt_provider.kode_perusahaan INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_rekanan_det.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.tc_permintaan_rekanan_det.kode_brg, dbo.tc_permintaan_rekanan_det.satuan, dbo.tc_permintaan_rekanan_det.penerimaan_brg, 
                      dbo.tc_permintaan_rekanan_det.kekurangan, dbo.tc_permintaan_rekanan_det.harga_beli, dbo.tc_permintaan_rekanan_det.harga_jual, 
                      dbo.tc_permintaan_rekanan_det.status_ver, dbo.tc_permintaan_rekanan_det.flag, dbo.tc_permintaan_rekanan.kode_perusahaan, dbo.mt_provider.nama_provider, 
                      dbo.mt_barang.nama_brg, dbo.tc_permintaan_rekanan.id_dd_user, dbo.tc_permintaan_rekanan.id_tc_permintaan_rekanan, 
                      MONTH(dbo.tc_permintaan_rekanan_det.tgl_kirim), YEAR(dbo.tc_permintaan_rekanan_det.tgl_kirim), dbo.mt_barang.harga_satuan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_amprah_gudang_keinhos_v]");
    }
};
