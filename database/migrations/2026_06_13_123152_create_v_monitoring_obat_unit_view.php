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
        DB::statement("CREATE VIEW dbo.v_monitoring_obat_unit
AS
SELECT     TOP (100) PERCENT dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, dbo.tc_permintaan_inst.kode_bagian_minta, 
                      dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.jumlah_penerimaan, dbo.mt_barang.nama_brg, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_permintaan_inst.tgl_pengiriman, dbo.tc_permintaan_inst.nomor_pengiriman
FROM         dbo.mt_barang INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.mt_barang.kode_brg = dbo.tc_permintaan_inst_det.kode_brg INNER JOIN
                      dbo.tc_permintaan_inst ON dbo.tc_permintaan_inst_det.id_tc_permintaan_inst = dbo.tc_permintaan_inst.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian
WHERE     (NOT (dbo.tc_permintaan_inst.tgl_pengiriman IS NULL)) AND (dbo.tc_permintaan_inst_det.jumlah_penerimaan > 0)
ORDER BY dbo.tc_permintaan_inst.nomor_permintaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_monitoring_obat_unit]");
    }
};
