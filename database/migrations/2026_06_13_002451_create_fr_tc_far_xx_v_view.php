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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_tc_far_xx_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_resep, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.flag_resep, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.flag_perawat
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far
GROUP BY dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.kode_resep, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.flag_resep, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.flag_perawat
HAVING      (dbo.fr_tc_far.status_transaksi IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_far_xx_v]");
    }
};
