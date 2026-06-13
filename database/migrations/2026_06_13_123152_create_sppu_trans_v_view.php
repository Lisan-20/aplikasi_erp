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
        DB::statement("CREATE VIEW dbo.sppu_trans_v
AS
SELECT        TOP (200) MAX(kd_trans_bendahara) AS kd_trans_bendahara, kd_group_trans, acc_no, uraian_trans, int
FROM            dbo.trans_bendahara
GROUP BY kd_group_trans, acc_no, uraian_trans, int
HAVING        (kd_group_trans = 15) AND (acc_no IS NOT NULL)
ORDER BY uraian_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sppu_trans_v]");
    }
};
