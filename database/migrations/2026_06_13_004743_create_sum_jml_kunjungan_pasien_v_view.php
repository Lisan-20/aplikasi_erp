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
        DB::statement("CREATE OR ALTER VIEW dbo.sum_jml_kunjungan_pasien_v
AS
SELECT     TOP (100) PERCENT CASE WHEN val IS NULL THEN '010001' WHEN val = '050001' THEN '010001' ELSE val END AS validasi, COUNT(dbo.lap_kunjungan_pasien_v.no_registrasi) AS jml_pasien, 
                      MONTH(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk) AS bln, YEAR(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk) AS thn, dbo.lap_kunjungan_pasien_v.stat_pasien
FROM         dbo.mt_bagian AS mt_bagian_1 RIGHT OUTER JOIN
                      dbo.lap_kunjungan_pasien_v ON mt_bagian_1.kode_bagian = dbo.lap_kunjungan_pasien_v.kode_bagian_tujuan
GROUP BY CASE WHEN val IS NULL THEN '010001' WHEN val = '050001' THEN '010001' ELSE val END, MONTH(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk), 
                      YEAR(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk), dbo.lap_kunjungan_pasien_v.stat_pasien
HAVING      (YEAR(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk) > 2015)
ORDER BY bln, CASE WHEN val IS NULL THEN '010001' WHEN val = '050001' THEN '010001' ELSE val END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_jml_kunjungan_pasien_v]");
    }
};
