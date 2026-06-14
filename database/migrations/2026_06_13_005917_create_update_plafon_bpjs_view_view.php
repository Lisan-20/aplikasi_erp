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
        DB::statement("CREATE OR ALTER VIEW dbo.update_plafon_bpjs_view
AS
SELECT     dbo.tc_registrasi.noSep, dbo.tc_registrasi.plafon_bpjs, dbo.rj_plafon_bpjs_apr.[Total Tarif]
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.rj_plafon_bpjs_apr ON dbo.tc_registrasi.noSep = dbo.rj_plafon_bpjs_apr.[No# SEP]
WHERE     (dbo.tc_registrasi.plafon_bpjs = 0) AND (NOT (dbo.tc_registrasi.noSep IN
                          (SELECT     No#SEP
                            FROM          dbo.upd_pendingan_sep)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_plafon_bpjs_view]");
    }
};
