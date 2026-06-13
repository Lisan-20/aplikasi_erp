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
        DB::statement("CREATE OR ALTER VIEW dbo.db_tc_trans_union_view
AS
SELECT     acc_no, tgl_transaksi, kode_bagian, tx_tipe, kd_trans_bendahara, MIN(DISTINCT jumlah) AS jumlah, id_bd_tc_trans
FROM         dbo.bd_tc_trans_union_v
GROUP BY acc_no, tgl_transaksi, kode_bagian, tx_tipe, kd_trans_bendahara, id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [db_tc_trans_union_view]");
    }
};
