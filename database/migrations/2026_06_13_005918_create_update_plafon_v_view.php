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
        DB::statement("CREATE OR ALTER VIEW dbo.update_plafon_v
AS
SELECT        dbo.tc_registrasi.plafon_bpjs, dbo.tc_sep_ri_temp.total_tarif, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_sep_ri_temp.tgl_pulang
FROM            dbo.tc_registrasi INNER JOIN
                         dbo.tc_sep_ri_temp ON dbo.tc_registrasi.no_mr = dbo.tc_sep_ri_temp.no_mr AND dbo.tc_registrasi.noSep = dbo.tc_sep_ri_temp.no_sep
WHERE        (dbo.tc_registrasi.plafon_bpjs IS NULL OR
                         dbo.tc_registrasi.plafon_bpjs = 0) AND (dbo.tc_sep_ri_temp.total_tarif > 0) AND (dbo.tc_registrasi.tgl_jam_keluar IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_plafon_v]");
    }
};
