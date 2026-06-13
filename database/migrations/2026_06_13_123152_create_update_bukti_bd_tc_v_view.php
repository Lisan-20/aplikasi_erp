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
        DB::statement("CREATE OR ALTER VIEW dbo.update_bukti_bd_tc_v
AS
SELECT     TOP (200) dbo.bd_tc_trans_detail.id_bd_tc_trans_det, dbo.bd_tc_trans_detail.id_bd_tc_trans, dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans.no_bukti AS bukti
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.bd_tc_trans ON dbo.bd_tc_trans_detail.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans_detail.id_bd_tc_trans IN (1629, 1631, 1632, 1641))
ORDER BY dbo.bd_tc_trans_detail.id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_bukti_bd_tc_v]");
    }
};
