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
        DB::statement("CREATE OR ALTER VIEW dbo.api_regitrasi_sum_v
AS
SELECT     TOP (100) PERCENT MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, COUNT(dbo.tc_registrasi.kode_kelompok) AS jml, 
                      dbo.mt_nasabah.nama_kelompok
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok
GROUP BY YEAR(dbo.tc_registrasi.tgl_jam_masuk), MONTH(dbo.tc_registrasi.tgl_jam_masuk), dbo.mt_nasabah.nama_kelompok
ORDER BY bln, thn DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [api_regitrasi_sum_v]");
    }
};
