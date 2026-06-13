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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_permintaan_v
AS
SELECT     dbo.tc_permintaan_inst.id_tc_permintaan_inst, dbo.tc_permintaan_inst_det.id_tc_permintaan_inst_det, dbo.tc_permintaan_inst.nomor_permintaan, dbo.tc_permintaan_inst.tgl_permintaan, 
                      dbo.tc_permintaan_inst_det.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_permintaan_inst_det.jumlah_permintaan, dbo.mt_barang.satuan_kecil, dbo.mt_bagian.nama_bagian AS nama_bagian_minta,
                       mt_bagian_1.nama_bagian AS nama_bagian_kirim, dbo.mt_barang.satuan_besar, dbo.mt_barang.[content]
FROM         dbo.tc_permintaan_inst INNER JOIN
                      dbo.tc_permintaan_inst_det ON dbo.tc_permintaan_inst.id_tc_permintaan_inst = dbo.tc_permintaan_inst_det.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_inst_det.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst.kode_bagian_minta = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_bagian AS mt_bagian_1 ON dbo.tc_permintaan_inst.kode_bagian_kirim = mt_bagian_1.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_permintaan_v]");
    }
};
