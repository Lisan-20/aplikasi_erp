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
        DB::statement("CREATE OR ALTER VIEW dbo.v_group_bagian_biaya
AS
SELECT     dbo.mt_account.acc_nama, dbo.mt_account.acc_no AS acc_no_biaya, dbo.mt_account.level_coa, dbo.v_group_bagian.acc_ref_biaya, 
                      dbo.v_group_bagian.kd_bag_unit, dbo.v_group_bagian.nama_bagian
FROM         dbo.v_group_bagian INNER JOIN
                      dbo.mt_account ON dbo.v_group_bagian.acc_ref_biaya = dbo.mt_account.referensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_group_bagian_biaya]");
    }
};
