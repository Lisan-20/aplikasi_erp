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
        DB::statement("CREATE VIEW dbo.piutang_rs_cab_v
AS
SELECT     dbo.tc_trans_gudang.kode_trans_gudang, dbo.tc_trans_gudang.rs_cabang, dbo.tc_trans_gudang.nama_rs_cabang, dbo.tc_trans_gudang.tgl_transaksi, 
                      SUM(dbo.tc_trans_gudang.total_harga) AS total_harga, dbo.tc_trans_gudang.status_bayar, dbo.gd_fr_tc_gudang.no_kirim, dbo.tc_trans_gudang.petugas, 
                      dbo.dd_user.username, dbo.tc_trans_gudang.id_bd_tc_trans, dbo.tc_trans_gudang.tgl_bayar, dbo.tc_trans_gudang.tgl_ver, dbo.tc_trans_gudang.flag_jurnal
FROM         dbo.tc_trans_gudang INNER JOIN
                      dbo.gd_fr_tc_gudang ON dbo.tc_trans_gudang.kode_trans_gudang = dbo.gd_fr_tc_gudang.kode_trans_gudang INNER JOIN
                      dbo.dd_user ON dbo.tc_trans_gudang.petugas = dbo.dd_user.id_dd_user
GROUP BY dbo.tc_trans_gudang.kode_trans_gudang, dbo.tc_trans_gudang.rs_cabang, dbo.tc_trans_gudang.nama_rs_cabang, dbo.tc_trans_gudang.tgl_transaksi, 
                      dbo.tc_trans_gudang.status_bayar, dbo.gd_fr_tc_gudang.no_kirim, dbo.tc_trans_gudang.petugas, dbo.dd_user.username, dbo.tc_trans_gudang.id_bd_tc_trans, 
                      dbo.tc_trans_gudang.tgl_bayar, dbo.tc_trans_gudang.tgl_ver, dbo.tc_trans_gudang.flag_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [piutang_rs_cab_v]");
    }
};
