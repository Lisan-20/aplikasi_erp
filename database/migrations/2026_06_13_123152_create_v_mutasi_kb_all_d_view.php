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
        DB::statement("CREATE OR ALTER VIEW dbo.v_mutasi_kb_all_d
AS
SELECT     Id_Kas_Bank, Kas_Bank, acc_no, tx_uraian, tx_tgl AS tgl_transaksi, kode_bagian, tx_tipe, kd_trans_bendahara, jumlah
FROM         dbo.v_mutasi_kb_all
WHERE     (acc_no = '1110101') AND (tx_tipe = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_mutasi_kb_all_d]");
    }
};
