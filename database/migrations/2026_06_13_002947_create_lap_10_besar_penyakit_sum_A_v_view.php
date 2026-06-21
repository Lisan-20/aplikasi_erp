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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_10_besar_penyakit_sum_A_v
AS
SELECT     TOP (100) PERCENT bulan, tahun, tipe_rl, SUM(jumlah) AS jumlah, kode_icd, nama_icd_10, nomer, no_urut_dtd, no_dtd, no_urut_bulan, nama_group, 
                      icd_10
FROM         dbo.lap_10_besar_penyakit_sum_new_v
GROUP BY bulan, tahun, tipe_rl, kode_icd, nama_icd_10, nomer, no_urut_dtd, no_dtd, no_urut_bulan, nama_group, icd_10
HAVING      (tipe_rl = 'A')
ORDER BY SUM(jumlah) DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_10_besar_penyakit_sum_A_v]");
    }
};
