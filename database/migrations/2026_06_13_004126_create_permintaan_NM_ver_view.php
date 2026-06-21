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
        DB::statement("CREATE OR ALTER VIEW dbo.permintaan_NM_ver
AS
SELECT     TOP (100) PERCENT dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst, dbo.tc_permintaan_inst_nm.nomor_permintaan, dbo.tc_permintaan_inst_nm.tgl_permintaan, 
                      dbo.tc_permintaan_inst_nm.kode_bagian_minta, dbo.tc_permintaan_inst_nm.kode_bagian_kirim, dbo.tc_permintaan_inst_nm.id_dd_user, 
                      dbo.tc_permintaan_inst_nm_det.jumlah_permintaan, dbo.tc_permintaan_inst_nm_det.kode_brg, dbo.mt_barang_nm.nama_brg, 
                      dbo.tc_permintaan_inst_nm_det.satuan, dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan, dbo.tc_permintaan_inst_nm_det.tgl_ver, 
                      dbo.tc_permintaan_inst_nm_det.status_ver, dbo.tc_permintaan_inst_nm_det.tgl_kirim, dbo.mt_bagian.nama_bagian AS bagian_minta, 
                      dbo.tc_permintaan_inst_nm.yg_terima, dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst_det
FROM         dbo.mt_bagian INNER JOIN
                      dbo.tc_permintaan_inst_nm ON dbo.mt_bagian.kode_bagian = dbo.tc_permintaan_inst_nm.kode_bagian_minta INNER JOIN
                      dbo.mt_barang_nm INNER JOIN
                      dbo.tc_permintaan_inst_nm_det ON dbo.mt_barang_nm.kode_brg = dbo.tc_permintaan_inst_nm_det.kode_brg ON 
                      dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst = dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst
WHERE     (dbo.tc_permintaan_inst_nm_det.jumlah_penerimaan > 0)
ORDER BY dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [permintaan_NM_ver]");
    }
};
