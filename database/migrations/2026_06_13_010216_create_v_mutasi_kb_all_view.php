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
        DB::statement("CREATE OR ALTER VIEW dbo.v_mutasi_kb_all
AS
SELECT     TOP (100) PERCENT dbo.kas_bank.Id_Kas_Bank, dbo.kas_bank.Kas_Bank, dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.uraian AS tx_uraian, 
                      dbo.bd_tc_trans_detail.tgl_transaksi AS tx_tgl, dbo.bd_tc_trans_detail.kode_bagian, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans_detail.kd_trans_bendahara, dbo.bd_tc_trans_detail.jumlah
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.kas_bank ON dbo.bd_tc_trans_detail.acc_no = dbo.kas_bank.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_mutasi_kb_all]");
    }
};
