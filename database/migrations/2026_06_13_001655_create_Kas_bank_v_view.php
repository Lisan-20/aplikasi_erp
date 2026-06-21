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
        DB::statement("CREATE OR ALTER VIEW dbo.Kas_bank_v
AS
SELECT     dbo.kas_bank.Id_Kas_Bank AS id_bank, dbo.kas_bank.Kas_Bank, dbo.kas_bank.acc_no, dbo.mt_account.acc_nama
FROM         dbo.kas_bank INNER JOIN
                      dbo.mt_account ON dbo.kas_bank.acc_no = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [Kas_bank_v]");
    }
};
