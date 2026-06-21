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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_jadwal_dokter_v
AS
SELECT     TOP (100) PERCENT DAY(tgl_praktek) AS tgl, MONTH(tgl_praktek) AS bln, YEAR(tgl_praktek) AS thn, kode_dokter, kode_bagian, kode_jadwal, tgl_praktek, 
                      flag_ver
FROM         dbo.tc_jadwal_dokter
WHERE     (kode_jadwal = '3') AND (kode_bagian = '020101') AND (flag_ver = 1)
ORDER BY tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_jadwal_dokter_v]");
    }
};
