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
        DB::statement("CREATE VIEW dbo.update_sep_pending_v
AS
SELECT     dbo.upd_sep_pending.no_sep, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.plafon_bpjs, dbo.tc_sep_ri_temp.total_tarif, dbo.tc_sep_ri_temp.tarif_rs
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.upd_sep_pending ON dbo.tc_registrasi.noSep = dbo.upd_sep_pending.no_sep INNER JOIN
                      dbo.tc_sep_ri_temp ON dbo.upd_sep_pending.no_sep = dbo.tc_sep_ri_temp.no_sep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_sep_pending_v]");
    }
};
