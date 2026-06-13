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
        DB::statement("CREATE VIEW dbo.bd_tc_trans_debet
AS
SELECT     dbo.bd_tc_trans.id_bd_tc_trans, SUM(dbo.bd_tc_trans_detail.jumlah) AS debet
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans_detail.tx_tipe = 0)
GROUP BY dbo.bd_tc_trans.id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_debet]");
    }
};
