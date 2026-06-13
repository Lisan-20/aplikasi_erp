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
        DB::statement("CREATE OR ALTER VIEW dbo.update_sep_ri_temp_v
AS
SELECT        dbo.tc_registrasi.diagAwal, dbo.tc_registrasi.kdDiag, dbo.tc_sep_ri_temp.total_tarif, dbo.tc_sep_ri_temp.kode_cbg, dbo.tc_registrasi.plafon_bpjs, 
                         dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_sep_ri_temp.no_sep, dbo.tc_registrasi.diagnosa, dbo.tc_sep_ri_temp.jenis, 
                         dbo.tc_sep_ri_temp.tgl_masuk, dbo.tc_registrasi.code
FROM            dbo.tc_sep_ri_temp INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_sep_ri_temp.no_sep = dbo.tc_registrasi.noSep
WHERE        (dbo.tc_sep_ri_temp.kode_cbg = 'O-7-10-0') AND (dbo.tc_sep_ri_temp.no_sep LIKE '0132%') AND (dbo.tc_registrasi.code <> '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_sep_ri_temp_v]");
    }
};
