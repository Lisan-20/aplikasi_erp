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
        DB::statement("CREATE VIEW dbo.cek_ver_bdtc_k_v
AS
SELECT     id_bd_tc_trans, no_bukti, SUM(jumlah) AS K, tgl_transaksi, tgl_ver, tx_tipe
FROM         dbo.bd_tc_trans_detail
GROUP BY id_bd_tc_trans, no_bukti, tgl_transaksi, tgl_ver, tx_tipe
HAVING      (tx_tipe = 1) AND (tgl_ver IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_ver_bdtc_k_v]");
    }
};
