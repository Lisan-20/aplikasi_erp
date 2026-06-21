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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_upload_v
AS
SELECT     bill_rs_kapitasi, bill_dr1_kapitasi, total_kapitasi, bill_dr1_kapitasi + bill_rs_kapitasi AS total
FROM         dbo.Upload_lagi
WHERE     (no_urut IN (2, 3)) AND (bill_dr1_kapitasi + bill_rs_kapitasi > total_kapitasi)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_upload_v]");
    }
};
