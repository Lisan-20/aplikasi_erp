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
        DB::statement("CREATE OR ALTER VIEW dbo.v_group_acc_biaya
AS
SELECT     acc_no, bulan, tahun, SUM(tx_nominal) AS total, [group]
FROM         dbo.laba_tx_harian_lev_4
WHERE     (bulan = 12) AND (tahun = 2017)
GROUP BY acc_no, bulan, tahun, [group]
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_group_acc_biaya]");
    }
};
