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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_igd_ankP_v
AS
SELECT     TOP (100) PERCENT tgl, bln, thn, COUNT(jml_pas) AS jmlPas, jen_kelamin
FROM         dbo.lap_kunjungan_igd_all_v
WHERE     (umur <= 15)
GROUP BY tgl, bln, thn, jen_kelamin
HAVING      (jen_kelamin = 'P')
ORDER BY bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_igd_ankP_v]");
    }
};
