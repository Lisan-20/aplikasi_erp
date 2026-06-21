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
        DB::statement("CREATE OR ALTER VIEW dbo.update_transBank
AS
SELECT     no_bukti, no_ref, bk, CAST(bk + '-' + CAST(No AS varchar) AS varchar) AS no_bukti_upd
FROM         dbo.satu_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_transBank]");
    }
};
