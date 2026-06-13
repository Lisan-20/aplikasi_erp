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
        DB::statement("CREATE OR ALTER VIEW dbo.th_icd_10_terbanyak_v
AS
SELECT     COUNT(kode_icd) AS jumlah, YEAR(tgl_jam) AS tahun, MONTH(tgl_jam) AS bulan, kode_icd, tipe_rl
FROM         dbo.th_icd10_pasien_ok_v
GROUP BY YEAR(tgl_jam), MONTH(tgl_jam), kode_icd, tipe_rl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd_10_terbanyak_v]");
    }
};
