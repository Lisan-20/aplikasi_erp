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
        DB::statement("CREATE VIEW dbo.update_sep_ri_v
AS
SELECT        dbo.sep_ri_manual_v.noKartuPeserta, dbo.sep_ri_manual_v.noSep AS SepRS, dbo.grouper_inacbgs_v.NoSep, dbo.grouper_inacbgs_v.NoPeserta, dbo.sep_ri_manual_v.no_mr, 
                         dbo.grouper_inacbgs_v.TglMasuk, dbo.grouper_inacbgs_v.TglKkeluar
FROM            dbo.sep_ri_manual_v INNER JOIN
                         dbo.grouper_inacbgs_v ON dbo.sep_ri_manual_v.TglMasuk = dbo.grouper_inacbgs_v.TglMasuk AND dbo.sep_ri_manual_v.TglKeluar = dbo.grouper_inacbgs_v.TglKkeluar AND 
                         dbo.sep_ri_manual_v.no_mr = dbo.grouper_inacbgs_v.no_mr
WHERE        (dbo.sep_ri_manual_v.noSep IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_sep_ri_v]");
    }
};
