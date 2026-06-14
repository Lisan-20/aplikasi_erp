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
        DB::statement("CREATE OR ALTER VIEW dbo.update_sep_dobel_v
AS
SELECT        dbo.sep_rj_manual_v.noKartuPeserta, dbo.sep_rj_manual_v.noSep AS SepRS, dbo.grouper_inacbgs_v.NoSep, dbo.grouper_inacbgs_v.NoPeserta, dbo.sep_rj_manual_v.no_mr, 
                         dbo.grouper_inacbgs_v.TglMasuk, dbo.grouper_inacbgs_v.TglKkeluar, dbo.sep_rj_manual_v.no_registrasi
FROM            dbo.sep_rj_manual_v INNER JOIN
                         dbo.grouper_inacbgs_v ON dbo.sep_rj_manual_v.TglMasuk = dbo.grouper_inacbgs_v.TglMasuk AND dbo.sep_rj_manual_v.TglKeluar = dbo.grouper_inacbgs_v.TglKkeluar AND 
                         dbo.sep_rj_manual_v.no_mr = dbo.grouper_inacbgs_v.no_mr AND dbo.sep_rj_manual_v.noSep <> dbo.grouper_inacbgs_v.NoSep
WHERE        (LEN(dbo.sep_rj_manual_v.noSep) > 19)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_sep_dobel_v]");
    }
};
