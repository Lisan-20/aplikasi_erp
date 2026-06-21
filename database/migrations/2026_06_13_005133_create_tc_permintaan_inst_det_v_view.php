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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_permintaan_inst_det_v
AS
SELECT     dbo.tc_permintaan_inst.id_tc_permintaan_inst, dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, 
                      dbo.tc_permintaan_inst.kode_bagian_minta AS kode_bagian, dbo.tc_permintaan_inst.kode_bagian_kirim, dbo.tc_permintaan_inst.status_batal, 
                      dbo.tc_permintaan_inst.tgl_input, dbo.tc_permintaan_inst.id_dd_user, dbo.tc_permintaan_inst.nomor_pengiriman, dbo.tc_permintaan_inst.tgl_pengiriman, 
                      dbo.tc_permintaan_inst.yg_serah, dbo.tc_permintaan_inst.yg_terima, dbo.tc_permintaan_inst.tgl_input_terima, dbo.tc_permintaan_inst.id_dd_user_terima, 
                      dbo.tc_permintaan_inst.keterangan_kirim, dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.tc_permintaan_inst_det.kode_brg, dbo.tc_permintaan_inst_det.satuan, 
                      dbo.tc_permintaan_inst_det.penerimaan_brg, dbo.tc_permintaan_inst_det.kekurangan, dbo.mt_bagian.nama_bagian, dbo.mt_barang.nama_brg
FROM         dbo.tc_permintaan_inst INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst RIGHT OUTER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg RIGHT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_permintaan_inst_det_v]");
    }
};
