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
        DB::statement("CREATE OR ALTER VIEW dbo.permintaan_medis_ver
AS
SELECT     TOP (100) PERCENT dbo.tc_permintaan_inst.id_tc_permintaan_inst, dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, dbo.tc_permintaan_inst.kode_bagian_minta, 
                      dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.id_dd_user, dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.kode_brg, dbo.mt_barang.nama_brg, 
                      dbo.tc_permintaan_inst_det.satuan, dbo.tc_permintaan_inst_det.jumlah_penerimaan, dbo.tc_permintaan_inst_det.tgl_ver, dbo.tc_permintaan_inst_det.status_ver, 
                      dbo.tc_permintaan_inst_det.tgl_kirim, dbo.mt_bagian.nama_bagian AS bagian_minta, dbo.tc_permintaan_inst.yg_terima, dbo.tc_permintaan_inst_det.id_tc_permintaan_inst_det, 
                      dbo.mt_bagian.kode_bagian
FROM         dbo.tc_permintaan_inst INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_permintaan_inst_det.jumlah_penerimaan > 0)
ORDER BY dbo.tc_permintaan_inst.id_tc_permintaan_inst
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [permintaan_medis_ver]");
    }
};
