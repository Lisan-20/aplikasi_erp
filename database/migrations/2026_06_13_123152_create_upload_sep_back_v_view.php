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
        DB::statement("CREATE VIEW dbo.upload_sep_back_v
AS
SELECT     TOP (100) PERCENT dbo.upload_sep_temp_back.total_tarif, dbo.upload_sep_temp_back.no_mr AS no_mr_sep, dbo.upload_sep_temp_back.no_sep, dbo.upload_sep_temp_back.topup, 
                      dbo.tc_registrasi.noSep, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.no_mr
FROM         dbo.upload_sep_temp_back INNER JOIN
                      dbo.tc_registrasi ON dbo.upload_sep_temp_back.no_sep = dbo.tc_registrasi.noSep
WHERE     (dbo.tc_registrasi.status_batal IS NULL)
ORDER BY no_mr_sep
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upload_sep_back_v]");
    }
};
