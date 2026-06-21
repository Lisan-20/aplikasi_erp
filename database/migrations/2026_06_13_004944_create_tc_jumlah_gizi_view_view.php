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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_jumlah_gizi_view
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jml, DAY(dbo.tc_sensus_gizi.tgl) AS tgl, MONTH(dbo.tc_sensus_gizi.tgl) AS bln, YEAR(dbo.tc_sensus_gizi.tgl) AS thn, dbo.tc_registrasi.umur, 
                      dbo.tc_sensus_gizi.distribusi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.tc_registrasi.no_registrasi = dbo.tc_sensus_gizi.no_registrasi
GROUP BY DAY(dbo.tc_sensus_gizi.tgl), MONTH(dbo.tc_sensus_gizi.tgl), YEAR(dbo.tc_sensus_gizi.tgl), dbo.tc_registrasi.umur, dbo.tc_sensus_gizi.distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_jumlah_gizi_view]");
    }
};
