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
        DB::statement("CREATE VIEW dbo.tc_trans_pelayanan_diskon_all_v
AS
SELECT     no_registrasi, no_mr, bill_rs, bill_dr1, bill_dr2, diskon_dr1, diskon_dr2, diskon_rs
FROM         dbo.tc_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_diskon_all_v]");
    }
};
