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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_10_besar_penyakit_sum_v
AS
SELECT     TOP (100) PERCENT bulan, tahun, tipe_rl, COUNT(kode_icd) AS jumlah, kode_icd, nama_icd_10
FROM         dbo.lap_10_besar_penyakit_v
GROUP BY bulan, tahun, tipe_rl, kode_icd, nama_icd_10
ORDER BY jumlah DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_10_besar_penyakit_sum_v]");
    }
};
