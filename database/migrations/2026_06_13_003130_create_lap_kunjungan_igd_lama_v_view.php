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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_igd_lama_v
AS
SELECT     COUNT(jml_pas) AS jmlPas, tgl, bln, thn, stat_pasien
FROM         dbo.lap_kunjungan_igd_all_v
GROUP BY tgl, bln, thn, stat_pasien
HAVING      (stat_pasien = 'Lama')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_igd_lama_v]");
    }
};
