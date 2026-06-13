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
        DB::statement("CREATE VIEW dbo.lap_10_besar_penyakit_tahun_sum_v
AS
SELECT        TOP (100) PERCENT tahun, tipe_rl, SUM(jumlah) AS jumlah, kode_icd, nama_icd_10
FROM            dbo.lap_10_besar_penyakit_sum_v
GROUP BY tahun, tipe_rl, kode_icd, nama_icd_10
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_10_besar_penyakit_tahun_sum_v]");
    }
};
