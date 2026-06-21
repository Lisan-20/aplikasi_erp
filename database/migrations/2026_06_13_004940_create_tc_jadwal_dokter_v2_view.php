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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_jadwal_dokter_v2
AS
SELECT     DAY(tgl_praktek) AS tgl, MONTH(tgl_praktek) AS bln, YEAR(tgl_praktek) AS thn, kode_dokter, kode_bagian, kode_jadwal, tgl_praktek, flag_ver
FROM         dbo.tc_jadwal_dokter
WHERE     (kode_dokter IN (220, 221))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_jadwal_dokter_v2]");
    }
};
