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
        DB::statement("CREATE OR ALTER VIEW dbo.v_bd_tc_trans_cek
AS
SELECT     COUNT(dbo.bd_tc_trans_detail.id_bd_tc_trans) AS hitung_id, dbo.bd_tc_trans_detail.id_bd_tc_trans
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.mt_account ON dbo.bd_tc_trans_detail.acc_no = dbo.mt_account.acc_no COLLATE Latin1_General_CI_AS
GROUP BY dbo.bd_tc_trans_detail.id_bd_tc_trans
HAVING      (COUNT(dbo.bd_tc_trans_detail.id_bd_tc_trans) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_bd_tc_trans_cek]");
    }
};
