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
        DB::statement("CREATE VIEW dbo.detail_lap_rajal_bpjs_v
AS
SELECT     TOP (100) PERCENT COUNT(no_registrasi) AS rajal, SUM(nk_perusahaan) AS bill_rajal, tgl, bln, thn, SUM(Tarif) AS Tarif
FROM         dbo.laporan_rajal_bpjs_v
GROUP BY tgl, bln, thn
ORDER BY bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [detail_lap_rajal_bpjs_v]");
    }
};
