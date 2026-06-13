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
        DB::statement("CREATE VIEW dbo.sum_lap_kunjungan_ranap_fix_v
AS
SELECT     bln_masuk, thn_masuk, SUM(jumlah) AS hari_rawat, kode_bagian, COUNT(kode_ri) AS masuk, kelas_pas
FROM         dbo.lap_kunjungan_ranap_fix_v
GROUP BY bln_masuk, thn_masuk, kode_bagian, kelas_pas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_lap_kunjungan_ranap_fix_v]");
    }
};
