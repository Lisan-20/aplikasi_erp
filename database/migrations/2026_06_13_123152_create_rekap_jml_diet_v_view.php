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
        DB::statement("CREATE OR ALTER VIEW dbo.rekap_jml_diet_v
AS
SELECT     DAY(tgl) AS tgl, MONTH(tgl) AS bln, YEAR(tgl) AS thn, COUNT(no_registrasi) AS jumlah, kode_diet AS jns_diet, distribusi
FROM         dbo.tc_sensus_gizi
GROUP BY DAY(tgl), MONTH(tgl), YEAR(tgl), kode_diet, distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_jml_diet_v]");
    }
};
