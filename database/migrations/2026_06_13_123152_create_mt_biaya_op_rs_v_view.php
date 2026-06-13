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
        DB::statement("CREATE VIEW dbo.mt_biaya_op_rs_v
AS
SELECT     dbo.mt_biaya_op.kode_biaya, dbo.mt_biaya_op.nama_biaya, dbo.mt_biaya_op.kode_ref, dbo.mt_biaya_op.referensi, dbo.mt_biaya_op_detail.acc_no, 
                      dbo.mt_account.acc_nama, dbo.mt_account.acc_type
FROM         dbo.mt_biaya_op INNER JOIN
                      dbo.mt_biaya_op_detail ON dbo.mt_biaya_op.kode_biaya = dbo.mt_biaya_op_detail.kode_biaya AND 
                      dbo.mt_biaya_op.kode_ref = dbo.mt_biaya_op_detail.kode_ref LEFT OUTER JOIN
                      dbo.mt_account ON dbo.mt_biaya_op_detail.acc_no = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_biaya_op_rs_v]");
    }
};
