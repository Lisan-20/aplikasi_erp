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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_opdDlm_v
AS
SELECT     TOP (100) PERCENT SUM(jml_pas) AS jml_pas, tgl, bln, thn, kode_bagian
FROM         dbo.lap_kunjungan_pm_new_temp
WHERE     (NOT (asal_daftar LIKE '03%'))
GROUP BY tgl, bln, thn, kode_bagian
ORDER BY tgl, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_opdDlm_v]");
    }
};
