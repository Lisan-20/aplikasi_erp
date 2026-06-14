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
        DB::statement("CREATE OR ALTER VIEW dbo.v_saldo_awal_cashflow
AS
SELECT     TOP (100) PERCENT dbo.Bank_v.acc_nama, dbo.Bank_v.id_bank, dbo.Bank_v.Kas_Bank, dbo.Bank_v.urutan, dbo.tx_harian.acc_no, YEAR(dbo.tx_harian.tx_tgl) 
                      AS tahun, MONTH(dbo.tx_harian.tx_tgl) AS bulan, dbo.tx_harian.ko_wil
FROM         dbo.Bank_v LEFT OUTER JOIN
                      dbo.tx_harian ON dbo.Bank_v.acc_no = dbo.tx_harian.acc_no
GROUP BY dbo.Bank_v.acc_nama, dbo.Bank_v.id_bank, dbo.Bank_v.Kas_Bank, dbo.Bank_v.urutan, dbo.tx_harian.acc_no, YEAR(dbo.tx_harian.tx_tgl), 
                      MONTH(dbo.tx_harian.tx_tgl), dbo.tx_harian.ko_wil
ORDER BY dbo.Bank_v.urutan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_saldo_awal_cashflow]");
    }
};
