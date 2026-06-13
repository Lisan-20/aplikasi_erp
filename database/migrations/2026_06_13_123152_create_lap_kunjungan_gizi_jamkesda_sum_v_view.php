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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_gizi_jamkesda_sum_v
AS
SELECT     SUM(jml) AS jamkesda, tgl, bln, thn, distribusi
FROM         dbo.tc_gizi_view
WHERE     (kode_kelompok = 10)
GROUP BY tgl, bln, thn, distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_gizi_jamkesda_sum_v]");
    }
};
