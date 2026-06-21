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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_dws_laki_rajal_v
AS
SELECT     SUM(jml_pas) AS dws_laki, tgl, bln, thn, validasi_lap_rm
FROM         dbo.lap_kunjungan_LP_rajal_v
WHERE     (umur >= 15) AND (jen_kelamin = 'L')
GROUP BY tgl, bln, thn, validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_dws_laki_rajal_v]");
    }
};
