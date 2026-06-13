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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_pm_pt_v
AS
SELECT     SUM(jml_pas) AS pt, tgl, bln, thn, kode_bagian
FROM         dbo.lap_kunjungan_pm_new_temp
WHERE     (kode_kelompok = 5)
GROUP BY tgl, bln, thn, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_pt_v]");
    }
};
