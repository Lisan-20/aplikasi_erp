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
        DB::statement("CREATE OR ALTER VIEW dbo.T_hutang_k_v
AS
SELECT     acc_no, tx_tipe, tx_nominal, no_bukti, referensi, YEAR(tx_tgl) AS tahun, tx_tgl, kode_supplier, tx_uraian, kel_jurnal, tgl_tempo
FROM         dbo.tx_harian
WHERE     (acc_no = 2110101) AND (tx_tipe = 'K') AND (tx_tgl >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [T_hutang_k_v]");
    }
};
