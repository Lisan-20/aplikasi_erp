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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_RI_Max_2_v
AS
SELECT     TOP (100) PERCENT kode_tc_periksa, kode_rm, kode_pemeriksaan, hasil, no_registrasi, no_kunjungan, no_urut
FROM         dbo.tc_pemeriksaan_ri
WHERE     (kode_rm = 150) AND (kode_pemeriksaan > 185302) AND (kode_pemeriksaan <= 185316)
ORDER BY kode_tc_periksa DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_RI_Max_2_v]");
    }
};
