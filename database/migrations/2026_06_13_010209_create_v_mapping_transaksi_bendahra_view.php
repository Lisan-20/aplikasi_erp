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
        DB::statement("CREATE OR ALTER VIEW dbo.v_mapping_transaksi_bendahra
AS
SELECT     dbo.group_trans_bendahara.nama_group, dbo.trans_bendahara.acc_no, dbo.trans_bendahara.kas_bank, dbo.trans_bendahara.masuk_keluar, 
                      dbo.trans_bendahara.uraian_trans, dbo.mt_account.acc_nama, dbo.trans_bendahara.id_trans_bendahara, dbo.group_trans_bendahara.kd_group_trans
FROM         dbo.group_trans_bendahara INNER JOIN
                      dbo.trans_bendahara ON dbo.group_trans_bendahara.kd_group_trans = dbo.trans_bendahara.kd_group_trans LEFT OUTER JOIN
                      dbo.mt_account ON dbo.trans_bendahara.acc_no = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_mapping_transaksi_bendahra]");
    }
};
