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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_BpjsPbi_v
AS
SELECT     SUM(jml_pas) AS BpjsPbi, tgl, bln, thn, kode_bagian
FROM         dbo.lap_kunjungan_pm_new_temp
WHERE     (kode_kelompok = 9)
GROUP BY tgl, bln, thn, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_BpjsPbi_v]");
    }
};
