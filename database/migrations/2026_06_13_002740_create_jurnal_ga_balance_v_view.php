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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_ga_balance_v
AS
SELECT     dbo.jurnal_debet_v.debet, dbo.jurnal_kredit_v.kredit, dbo.jurnal_debet_v.no_bukti
FROM         dbo.jurnal_debet_v INNER JOIN
                      dbo.jurnal_kredit_v ON dbo.jurnal_debet_v.no_bukti = dbo.jurnal_kredit_v.no_bukti AND dbo.jurnal_debet_v.debet <> dbo.jurnal_kredit_v.kredit
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_ga_balance_v]");
    }
};
