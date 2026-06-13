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
        DB::statement("CREATE VIEW dbo.sep_upd_sep_v
AS
SELECT     YEAR(Tglklr) AS thn, MONTH(Tglklr) AS bln, DAY(Tglklr) AS tgl, TariffRS, NoSep, NoPeserta, no_mr, Los, Jnsrawat
FROM         dbo.GROUPER_INACBG_REST
WHERE     (Jnsrawat = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sep_upd_sep_v]");
    }
};
