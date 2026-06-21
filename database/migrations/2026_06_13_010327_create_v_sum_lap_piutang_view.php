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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sum_lap_piutang
AS
SELECT     acc_no, SUM(tx_nominal) AS tx_nominal, MONTH(tx_tgl) AS bln, YEAR(tx_tgl) AS thn, kode_perusahaan, tx_tipe
FROM         dbo.tx_harian
GROUP BY acc_no, YEAR(tx_tgl), MONTH(tx_tgl), kode_perusahaan, tx_tipe
HAVING      (acc_no = 1130104)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sum_lap_piutang]");
    }
};
