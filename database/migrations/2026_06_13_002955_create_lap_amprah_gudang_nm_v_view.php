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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_amprah_gudang_nm_v
AS
SELECT     dbo.tc_permintaan_inst_nm.kode_bagian_minta, dbo.tc_permintaan_inst_nm.kode_bagian_kirim, dbo.mt_bagian.nama_bagian AS bagian_minta, dbo.mt_barang_nm.nama_brg, 
                      dbo.tc_permintaan_inst_nm_det.kode_brg, dbo.tc_permintaan_inst_nm_det.satuan, dbo.tc_permintaan_inst_nm_det.jumlah_permintaan, dbo.tc_permintaan_inst_nm.tgl_permintaan
FROM         dbo.tc_permintaan_inst_nm_det INNER JOIN
                      dbo.tc_permintaan_inst_nm ON dbo.tc_permintaan_inst_nm_det.id_tc_permintaan_inst = dbo.tc_permintaan_inst_nm.id_tc_permintaan_inst INNER JOIN
                      dbo.mt_bagian ON dbo.tc_permintaan_inst_nm.kode_bagian_minta = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_barang_nm ON dbo.tc_permintaan_inst_nm_det.kode_brg = dbo.mt_barang_nm.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_amprah_gudang_nm_v]");
    }
};
