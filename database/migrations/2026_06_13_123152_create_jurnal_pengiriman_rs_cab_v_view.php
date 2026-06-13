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
        DB::statement("CREATE VIEW dbo.jurnal_pengiriman_rs_cab_v
AS
SELECT     dbo.gd_fr_tc_gudang.kode_trans_gudang, dbo.gd_fr_tc_gudang.kode_form_rs, dbo.gd_fr_tc_gudang.no_kirim, dbo.gd_fr_tc_gudang.kode_profit, 
                      dbo.gd_fr_tc_gudang.kode_bagian, dbo.gd_fr_tc_gudang.tgl_trans, dbo.gd_fr_tc_gudang.kode_perusahaan, dbo.gd_fr_tc_gudang.status_transaksi, 
                      dbo.gd_fr_tc_gudang.petugas, dbo.mt_perusahaan.nama_perusahaan, dbo.tc_trans_gudang.kode_tc_trans_gudang, dbo.tc_trans_gudang.kd_tr_kirim, 
                      dbo.tc_trans_gudang.rs_cabang, dbo.tc_trans_gudang.nama_rs_cabang, dbo.tc_trans_gudang.tgl_transaksi, dbo.tc_trans_gudang.kode_brg, 
                      dbo.tc_trans_gudang.nama_brg, dbo.tc_trans_gudang.total_harga, dbo.tc_trans_gudang.harga_sat, dbo.tc_trans_gudang.jumlah, dbo.tc_trans_gudang.flag_jurnal, 
                      dbo.tc_trans_gudang.tgl_ver
FROM         dbo.gd_fr_tc_gudang INNER JOIN
                      dbo.mt_perusahaan ON dbo.gd_fr_tc_gudang.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan INNER JOIN
                      dbo.tc_trans_gudang ON dbo.gd_fr_tc_gudang.kode_trans_gudang = dbo.tc_trans_gudang.kode_trans_gudang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pengiriman_rs_cab_v]");
    }
};
