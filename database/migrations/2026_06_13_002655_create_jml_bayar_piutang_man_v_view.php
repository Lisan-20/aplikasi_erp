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
        DB::statement("CREATE OR ALTER VIEW dbo.jml_bayar_piutang_man_v
AS
SELECT     SUM(jumlah) AS jumlah_bayar, no_ref
FROM         dbo.bd_tc_trans
GROUP BY no_ref
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_bayar_piutang_man_v]");
    }
};
