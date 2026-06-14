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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_trans_det
AS
SELECT     dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans_detail.no_ref, dbo.bd_tc_trans.no_bukti AS no_bukti_upd
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans.no_bukti LIKE '%bll%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_trans_det]");
    }
};
