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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_permintaan_inst_v
AS
SELECT     dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, dbo.tc_permintaan_inst.kode_bagian_minta, dbo.tc_permintaan_inst.kode_bagian_kirim, 
                      dbo.tc_permintaan_inst.status_batal, dbo.tc_permintaan_inst.tgl_input, dbo.tc_permintaan_inst.id_dd_user, dbo.mt_bagian.nama_bagian AS nama_bagian_minta, 
                      dbo.tc_permintaan_inst.id_tc_permintaan_inst, dbo.tc_permintaan_inst.nomor_pengiriman, dbo.tc_permintaan_inst.tgl_pengiriman, dbo.tc_permintaan_inst.yg_serah, 
                      dbo.tc_permintaan_inst.yg_terima, dbo.tc_permintaan_inst.tgl_input_terima, dbo.tc_permintaan_inst.id_dd_user_terima, dbo.tc_permintaan_inst.keterangan_kirim, 
                      SUM(CASE WHEN jumlah_permintaan IS NULL THEN 0 ELSE jumlah_permintaan END) AS jumlah_permintaan, SUM(CASE WHEN jumlah_penerimaan IS NULL 
                      THEN 0 ELSE jumlah_penerimaan END) AS jumlah_penerimaan
FROM         dbo.tc_permintaan_inst INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst LEFT OUTER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, dbo.tc_permintaan_inst.kode_bagian_minta, dbo.tc_permintaan_inst.kode_bagian_kirim, 
                      dbo.tc_permintaan_inst.status_batal, dbo.tc_permintaan_inst.tgl_input, dbo.tc_permintaan_inst.id_dd_user, dbo.mt_bagian.nama_bagian, dbo.tc_permintaan_inst.id_tc_permintaan_inst, 
                      dbo.tc_permintaan_inst.nomor_pengiriman, dbo.tc_permintaan_inst.tgl_pengiriman, dbo.tc_permintaan_inst.yg_serah, dbo.tc_permintaan_inst.yg_terima, dbo.tc_permintaan_inst.tgl_input_terima, 
                      dbo.tc_permintaan_inst.id_dd_user_terima, dbo.tc_permintaan_inst.keterangan_kirim
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_permintaan_inst_v]");
    }
};
