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
        DB::statement("CREATE VIEW dbo.tc_permintaan_nm_v
AS
SELECT     dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst, dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst_det, 
                      dbo.tc_permintaan_inst_nm.nomor_permintaan, dbo.tc_permintaan_inst_nm.tgl_permintaan, dbo.tc_permintaan_inst_nm_det.kode_brg, 
                      dbo.mt_barang_nm.nama_brg, dbo.tc_permintaan_inst_nm_det.jumlah_permintaan, dbo.mt_barang_nm.satuan_kecil, 
                      dbo.mt_bagian.nama_bagian AS nama_bagian_minta, mt_bagian_1.nama_bagian AS nama_bagian_kirim
FROM         dbo.tc_permintaan_inst_nm INNER JOIN
                      dbo.tc_permintaan_inst_nm_det ON 
                      dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst = dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_barang_nm ON dbo.tc_permintaan_inst_nm_det.kode_brg = dbo.mt_barang_nm.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst_nm.kode_bagian_minta = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_bagian AS mt_bagian_1 ON dbo.tc_permintaan_inst_nm.kode_bagian_kirim = mt_bagian_1.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_permintaan_nm_v]");
    }
};
