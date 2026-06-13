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
        DB::statement("CREATE VIEW dbo.jurnal_hutang_v
AS
SELECT        TOP (100) PERCENT dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.uraian, dbo.tx_harian.acc_no
FROM            dbo.bd_tc_trans INNER JOIN
                         dbo.tx_harian ON dbo.bd_tc_trans.no_bukti = dbo.tx_harian.no_bukti AND dbo.bd_tc_trans.uraian = dbo.tx_harian.tx_uraian
GROUP BY dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.uraian, dbo.tx_harian.acc_no
HAVING        (dbo.tx_harian.acc_no = 2110101)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_hutang_v]");
    }
};
