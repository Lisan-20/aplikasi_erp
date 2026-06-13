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
        DB::statement("CREATE VIEW dbo.posting_account_v
AS
SELECT     dbo.mt_account.acc_no, dbo.mt_account.level_coa, dbo.mt_account.acc_type, dbo.dd_konfigurasi.ko_wil
FROM         dbo.mt_account CROSS JOIN
                      dbo.dd_konfigurasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [posting_account_v]");
    }
};
