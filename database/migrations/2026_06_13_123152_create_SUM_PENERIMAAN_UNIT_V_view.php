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
        DB::statement("CREATE VIEW dbo.SUM_PENERIMAAN_UNIT_V
AS
SELECT     dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.kode_brg, dbo.tc_permintaan_inst_det.satuan, dbo.tc_permintaan_inst_det.tgl_kirim, 
                      dbo.tc_permintaan_inst_det.tgl_input, dbo.tc_permintaan_inst_det.jumlah_penerimaan, dbo.mt_rekap_stok.harga_beli, dbo.mt_rekap_stok.kode_bagian_gudang, 
                      dbo.mt_barang.nama_brg, dbo.mt_rekap_stok.harga_beli * dbo.tc_permintaan_inst_det.jumlah_penerimaan AS HARGA_P
FROM         dbo.tc_permintaan_inst_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.tc_permintaan_inst_det.tgl_kirim IS NOT NULL) AND (MONTH(dbo.tc_permintaan_inst_det.tgl_kirim) BETWEEN 7 AND 9) AND 
                      (dbo.mt_rekap_stok.kode_bagian_gudang = '060101') AND (dbo.tc_permintaan_inst_det.jumlah_penerimaan > 0) AND (dbo.mt_rekap_stok.harga_beli > 0) AND 
                      (dbo.tc_permintaan_inst_det.kode_brg <> 'E01A0280')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [SUM_PENERIMAAN_UNIT_V]");
    }
};
