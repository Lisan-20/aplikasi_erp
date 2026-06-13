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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_igd_umum_v
AS
SELECT     COUNT(jml_pas) AS jmlPas, tgl, bln, thn, kode_kelompok
FROM         dbo.lap_kunjungan_igd_all_v
GROUP BY tgl, bln, thn, kode_kelompok
HAVING      (kode_kelompok = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_igd_umum_v]");
    }
};
