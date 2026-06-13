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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_igd_baru_v
AS
SELECT     TOP (100) PERCENT COUNT(jml_pas) AS jmlPas, tgl, bln, thn, stat_pasien
FROM         dbo.lap_kunjungan_igd_all_v
GROUP BY tgl, bln, thn, stat_pasien
HAVING      (stat_pasien = 'Baru')
ORDER BY bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_igd_baru_v]");
    }
};
