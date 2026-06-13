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
        DB::statement("CREATE OR ALTER VIEW dbo.N_saldo_5_k_v
AS
SELECT     dbo.tx_harian.acc_no, SUM(dbo.tx_harian.tx_nominal) AS kredit, MONTH(dbo.tx_harian.tx_tgl) AS bulan, YEAR(dbo.tx_harian.tx_tgl) AS tahun, dbo.tx_harian.tx_tipe, 
                      dbo.mt_account.level_coa, dbo.mt_account.acc_type, dbo.mt_account.kode_utama, dbo.tx_harian.ko_wil
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
GROUP BY dbo.tx_harian.acc_no, MONTH(dbo.tx_harian.tx_tgl), YEAR(dbo.tx_harian.tx_tgl), dbo.tx_harian.tx_tipe, dbo.mt_account.level_coa, dbo.mt_account.acc_type, 
                      dbo.mt_account.kode_utama, dbo.tx_harian.ko_wil
HAVING      (dbo.tx_harian.tx_tipe = 'K') AND (dbo.mt_account.level_coa = 5)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [N_saldo_5_k_v]");
    }
};
