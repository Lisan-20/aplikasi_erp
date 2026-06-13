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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_aset_gedung_v
AS
SELECT     dbo.mt_biaya_op_detail.kode_biaya, dbo.mt_biaya_op_detail.acc_no, dbo.mt_biaya_op_detail.kode_ref, dbo.master_hist_bl.tahun, dbo.master_hist_bl.bulan, 
                      dbo.master_hist_bl.saldo_awal
FROM         dbo.mt_biaya_op_detail INNER JOIN
                      dbo.master_hist_bl ON dbo.mt_biaya_op_detail.acc_no = dbo.master_hist_bl.acc_no
WHERE     (dbo.mt_biaya_op_detail.kode_ref = 3) AND (dbo.mt_biaya_op_detail.kode_biaya = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_aset_gedung_v]");
    }
};
