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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rujuk_lama_v
AS
SELECT     bln, thn, id_dc_asal_pasien, kode_bagian, COUNT(no_registrasi) AS lama, stat_pasien, kode_kelompok, kode_perusahaan
FROM         dbo.new_lap_rujuk_regis_v
GROUP BY bln, id_dc_asal_pasien, thn, kode_bagian, stat_pasien, kode_kelompok, kode_perusahaan
HAVING      (stat_pasien = 'Lama')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rujuk_lama_v]");
    }
};
