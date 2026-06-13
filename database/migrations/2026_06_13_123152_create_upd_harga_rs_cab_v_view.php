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
        DB::statement("CREATE VIEW dbo.upd_harga_rs_cab_v
AS
SELECT     dbo.tc_trans_gudang.kd_tr_kirim, dbo.tc_trans_gudang.kode_brg, dbo.tc_trans_gudang.nama_brg, dbo.tc_trans_gudang.total_harga, dbo.tc_trans_gudang.harga_sat, 
                      dbo.gd_fr_tc_gudang_detail.harga_beli, dbo.gd_fr_tc_gudang_detail.harga_jual, dbo.tc_trans_gudang.jumlah
FROM         dbo.gd_fr_tc_gudang_detail INNER JOIN
                      dbo.tc_trans_gudang ON dbo.gd_fr_tc_gudang_detail.kd_tr_kirim = dbo.tc_trans_gudang.kd_tr_kirim
WHERE     (dbo.gd_fr_tc_gudang_detail.harga_beli <> dbo.gd_fr_tc_gudang_detail.harga_jual) AND (dbo.gd_fr_tc_gudang_detail.status_kirim = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_harga_rs_cab_v]");
    }
};
