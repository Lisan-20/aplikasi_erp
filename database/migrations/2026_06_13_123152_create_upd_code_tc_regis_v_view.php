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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_code_tc_regis_v
AS
SELECT        dbo.tc_registrasi.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.code, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.noSep, 
                         dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_sep_ri_temp.kode_cbg
FROM            dbo.tc_registrasi INNER JOIN
                         dbo.tc_sep_ri_temp ON dbo.tc_registrasi.no_mr = dbo.tc_sep_ri_temp.no_mr AND dbo.tc_registrasi.noSep = dbo.tc_sep_ri_temp.no_sep
WHERE        (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.kode_bagian_masuk = '050301') AND (dbo.tc_registrasi.noSep LIKE '-%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_code_tc_regis_v]");
    }
};
