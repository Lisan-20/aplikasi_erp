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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_jurnal_d_v
AS
SELECT     tx_nominal AS debet, MONTH(tx_tgl) AS bln, DAY(tx_tgl) AS tgl, no_bukti, kel_jurnal, acc_no, no_jurnal
FROM         dbo.tx_harian
WHERE     (tx_tipe = 'D') AND (YEAR(tx_tgl) >= 2016) AND (kel_jurnal = '21')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_jurnal_d_v]");
    }
};
