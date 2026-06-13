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
        DB::statement("CREATE VIEW dbo.subledger_v
AS
SELECT     dbo.mt_account.acc_no, dbo.subledger.subledger, dbo.subledger.nama_subledger, dbo.mt_account.acc_nama
FROM         dbo.mt_account INNER JOIN
                      dbo.subledger ON dbo.mt_account.sub_ledger = dbo.subledger.subledger COLLATE SQL_Latin1_General_CP1_CI_AS
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [subledger_v]");
    }
};
