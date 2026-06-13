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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_no_kuit_tran_kasir_v
AS
SELECT     dbo.tc_trans_kasir.no_kuitansi AS no_kuitansi_real, dbo.tc_trans_kasir.status_batal, dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tran_sed.no_kuitansi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tran_sed ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tran_sed.kode_tc_trans_kasir
WHERE     (dbo.tran_sed.no_kuitansi IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_no_kuit_tran_kasir_v]");
    }
};
