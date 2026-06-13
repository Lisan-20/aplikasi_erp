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
        DB::statement("CREATE VIEW dbo.bd_tc_trans_union_v
AS
SELECT     acc_no, tgl_transaksi, kode_bagian, tx_tipe, kd_trans_bendahara, jumlah, id_bd_tc_trans
FROM         dbo.bd_tc_trans
UNION
SELECT     acc_no, tgl_transaksi, kode_bagian, tx_tipe, kd_trans_bendahara, jumlah, id_bd_tc_trans
FROM         dbo.bd_tc_trans_detail
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_union_v]");
    }
};
