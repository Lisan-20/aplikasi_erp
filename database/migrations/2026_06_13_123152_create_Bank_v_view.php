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
        DB::statement("CREATE OR ALTER VIEW dbo.Bank_v
AS
SELECT     TOP (100) PERCENT dbo.kas_bank.Id_Kas_Bank AS id_bank, dbo.kas_bank.Kas_Bank, dbo.mt_account.acc_nama, dbo.mt_account.acc_no, dbo.kas_bank.urutan
FROM         dbo.kas_bank INNER JOIN
                      dbo.mt_account ON dbo.kas_bank.acc_no = dbo.mt_account.acc_no
WHERE     (dbo.kas_bank.Id_Kas_Bank <= 7)
ORDER BY dbo.kas_bank.urutan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [Bank_v]");
    }
};
