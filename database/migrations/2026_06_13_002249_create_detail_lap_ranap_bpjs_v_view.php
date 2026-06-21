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
        DB::statement("CREATE OR ALTER VIEW dbo.detail_lap_ranap_bpjs_v
AS
SELECT     TOP (100) PERCENT COUNT(no_registrasi) AS ranap, SUM(nk_perusahaan) AS bill_ranap, tgl, bln, thn, SUM(Tarif) AS Tarif
FROM         dbo.laporan_ranap2_bpjs_v
GROUP BY bln, thn, tgl
ORDER BY bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [detail_lap_ranap_bpjs_v]");
    }
};
