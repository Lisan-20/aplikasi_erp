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
        DB::statement("CREATE OR ALTER VIEW dbo.v_permintaan_unit
AS
SELECT     TOP (100) PERCENT MONTH(dbo.tc_permintaan_inst_det.tgl_kirim) AS Expr1, dbo.tc_permintaan_inst_det.jumlah_penerimaan, 
                      dbo.tc_permintaan_inst.kode_bagian_minta, dbo.mt_rekap_stok.harga_beli, 
                      dbo.tc_permintaan_inst_det.jumlah_penerimaan * dbo.mt_rekap_stok.harga_beli * 200 AS total_harga
FROM         dbo.tc_permintaan_inst_det INNER JOIN
                      dbo.tc_permintaan_inst ON dbo.tc_permintaan_inst_det.id_tc_permintaan_inst = dbo.tc_permintaan_inst.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.tc_permintaan_inst_det.tgl_kirim > 0) AND (dbo.tc_permintaan_inst_det.jumlah_penerimaan > 0) AND (MONTH(dbo.tc_permintaan_inst_det.tgl_kirim) BETWEEN 
                      7 AND 9) AND (dbo.tc_permintaan_inst_det.kode_brg IN ('E01A0735')) AND (dbo.mt_rekap_stok.kode_bagian_gudang = '060101')
ORDER BY Expr1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_permintaan_unit]");
    }
};
