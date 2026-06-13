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
        DB::statement("CREATE VIEW dbo.sum_pasien_keluar_ri_v
AS
SELECT     kode_bagian_tujuan, SUM(hari_rawat) AS jml_hari, COUNT(no_registrasi) AS keluar, MONTH(tgl_jam_keluar) AS bln, YEAR(tgl_jam_keluar) AS thn
FROM         dbo.lap_kunjungan_pasien_ranap_v
GROUP BY MONTH(tgl_jam_keluar), YEAR(tgl_jam_keluar), kode_bagian_tujuan
HAVING      (kode_bagian_tujuan LIKE '03%' AND NOT (kode_bagian_tujuan IN ('030901', '030501')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_pasien_keluar_ri_v]");
    }
};
