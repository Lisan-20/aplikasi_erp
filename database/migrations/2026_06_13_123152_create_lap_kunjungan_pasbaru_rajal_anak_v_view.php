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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_pasbaru_rajal_anak_v
AS
SELECT     SUM(jml_pas) AS baru_anak, tgl, bln, thn, validasi_lap_rm
FROM         dbo.lap_kunjungan_LP_rajal_v
WHERE     (stat_pasien = 'Baru') AND (umur < 15)
GROUP BY tgl, bln, thn, validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pasbaru_rajal_anak_v]");
    }
};
