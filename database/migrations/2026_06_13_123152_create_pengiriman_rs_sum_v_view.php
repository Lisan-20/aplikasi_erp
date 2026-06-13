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
        DB::statement("CREATE VIEW dbo.pengiriman_rs_sum_v
AS
SELECT     dbo.gd_fr_tc_gudang.kode_trans_gudang, dbo.gd_fr_tc_gudang.kode_form_rs, dbo.gd_fr_tc_gudang.no_kirim, dbo.gd_fr_tc_gudang.kode_profit, 
                      dbo.gd_fr_tc_gudang.kode_bagian, dbo.gd_fr_tc_gudang.tgl_trans, dbo.gd_fr_tc_gudang.kode_perusahaan, dbo.gd_fr_tc_gudang.status_transaksi, 
                      dbo.gd_fr_tc_gudang.petugas, dbo.gd_fr_tc_gudang.tgl_ver, dbo.gd_fr_tc_gudang.status_ver, dbo.gd_fr_tc_gudang.user_ver, 
                      SUM(dbo.pengiriman_rs_cab_v.total_harga) AS tx_nominal
FROM         dbo.pengiriman_rs_cab_v INNER JOIN
                      dbo.gd_fr_tc_gudang ON dbo.pengiriman_rs_cab_v.kode_trans_gudang = dbo.gd_fr_tc_gudang.kode_trans_gudang
GROUP BY dbo.gd_fr_tc_gudang.kode_trans_gudang, dbo.gd_fr_tc_gudang.kode_form_rs, dbo.gd_fr_tc_gudang.no_kirim, dbo.gd_fr_tc_gudang.kode_profit, 
                      dbo.gd_fr_tc_gudang.kode_bagian, dbo.gd_fr_tc_gudang.tgl_trans, dbo.gd_fr_tc_gudang.kode_perusahaan, dbo.gd_fr_tc_gudang.status_transaksi, 
                      dbo.gd_fr_tc_gudang.petugas, dbo.gd_fr_tc_gudang.tgl_ver, dbo.gd_fr_tc_gudang.status_ver, dbo.gd_fr_tc_gudang.user_ver
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengiriman_rs_sum_v]");
    }
};
