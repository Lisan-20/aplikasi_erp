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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_gizi_kelas_view
AS
SELECT     dbo.ri_tc_rawatinap.kelas_pas, COUNT(dbo.tc_sensus_gizi.no_registrasi) AS jml, DAY(dbo.tc_sensus_gizi.tgl) AS tgl, MONTH(dbo.tc_sensus_gizi.tgl) AS bln, YEAR(dbo.tc_sensus_gizi.tgl) AS thn, 
                      dbo.tc_sensus_gizi.distribusi
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_sensus_gizi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_sensus_gizi.no_registrasi
GROUP BY dbo.ri_tc_rawatinap.kelas_pas, DAY(dbo.tc_sensus_gizi.tgl), MONTH(dbo.tc_sensus_gizi.tgl), YEAR(dbo.tc_sensus_gizi.tgl), dbo.tc_sensus_gizi.distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_gizi_kelas_view]");
    }
};
