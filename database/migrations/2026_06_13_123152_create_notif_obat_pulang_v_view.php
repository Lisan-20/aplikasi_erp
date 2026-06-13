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
        DB::statement("CREATE VIEW dbo.notif_obat_pulang_v
AS
SELECT     TOP (100) PERCENT a.kode_trans_far, COUNT(b.kd_tr_resep) AS cek, a.no_mr
FROM         dbo.fr_tc_far AS a INNER JOIN
                      dbo.fr_tc_far_detail AS b ON a.kode_trans_far = b.kode_trans_far
WHERE     (a.flag_resep = 1) AND (a.stat_dr = 1) AND (a.kode_profit = 1000) AND (a.flag_obt_plang = 1) AND (a.status_transaksi IS NULL)
GROUP BY a.kode_trans_far, a.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [notif_obat_pulang_v]");
    }
};
