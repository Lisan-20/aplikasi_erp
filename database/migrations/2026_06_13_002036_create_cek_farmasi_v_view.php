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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_farmasi_v
AS
SELECT     dbo.fr_tc_far_detail.kode_trans_far, dbo.fr_tc_far_detail.status_kirim, dbo.tc_trans_pelayanan.kode_trans_far AS kode, dbo.fr_tc_far.no_mr
FROM         dbo.fr_tc_far_detail INNER JOIN
                      dbo.fr_tc_far ON dbo.fr_tc_far_detail.kode_trans_far = dbo.fr_tc_far.kode_trans_far LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fr_tc_far_detail.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far
GROUP BY dbo.fr_tc_far_detail.kode_trans_far, dbo.fr_tc_far_detail.status_kirim, dbo.tc_trans_pelayanan.kode_trans_far, dbo.fr_tc_far.no_mr
HAVING      (dbo.fr_tc_far_detail.status_kirim = 1) AND (dbo.tc_trans_pelayanan.kode_trans_far IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_farmasi_v]");
    }
};
