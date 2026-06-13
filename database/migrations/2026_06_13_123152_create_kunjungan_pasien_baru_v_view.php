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
        DB::statement("CREATE OR ALTER VIEW dbo.kunjungan_pasien_baru_v
AS
SELECT     TOP (100) PERCENT CASE WHEN dbo.lap_kunjungan_pasien_v.validasi IS NULL 
                      THEN '010001' WHEN dbo.lap_kunjungan_pasien_v.validasi = '050001' THEN '010001' ELSE dbo.lap_kunjungan_pasien_v.validasi END AS validasi, 
                      COUNT(dbo.lap_kunjungan_pasien_v.no_registrasi) AS jml_pasien, MONTH(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk) AS bln, 
                      YEAR(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk) AS thn, dbo.lap_kunjungan_pasien_v.stat_pasien, dbo.lap_kunjungan_pasien_v.kode_kelompok, 
                      dbo.lap_kunjungan_pasien_v.kode_bagian_tujuan, CASE WHEN kode_perusahaan IS NULL THEN 0 ELSE kode_perusahaan END AS perusahaan, 
                      CASE WHEN kode_dokter IS NULL THEN 0 ELSE kode_dokter END AS kode_dokter
FROM         dbo.mt_bagian AS mt_bagian_1 RIGHT OUTER JOIN
                      dbo.lap_kunjungan_pasien_v ON mt_bagian_1.kode_bagian = dbo.lap_kunjungan_pasien_v.kode_bagian_tujuan
GROUP BY CASE WHEN dbo.lap_kunjungan_pasien_v.validasi IS NULL 
                      THEN '010001' WHEN dbo.lap_kunjungan_pasien_v.validasi = '050001' THEN '010001' ELSE dbo.lap_kunjungan_pasien_v.validasi END, 
                      MONTH(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk), YEAR(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk), dbo.lap_kunjungan_pasien_v.stat_pasien, 
                      dbo.lap_kunjungan_pasien_v.kode_kelompok, dbo.lap_kunjungan_pasien_v.kode_bagian_tujuan, CASE WHEN kode_perusahaan IS NULL 
                      THEN 0 ELSE kode_perusahaan END, CASE WHEN kode_dokter IS NULL THEN 0 ELSE kode_dokter END
HAVING      (YEAR(dbo.lap_kunjungan_pasien_v.tgl_jam_masuk) >= 2016) AND (dbo.lap_kunjungan_pasien_v.kode_bagian_tujuan IS NOT NULL) AND 
                      (dbo.lap_kunjungan_pasien_v.stat_pasien = 'Baru')
ORDER BY dbo.lap_kunjungan_pasien_v.kode_kelompok, CASE WHEN dbo.lap_kunjungan_pasien_v.validasi IS NULL 
                      THEN '010001' WHEN dbo.lap_kunjungan_pasien_v.validasi = '050001' THEN '010001' ELSE dbo.lap_kunjungan_pasien_v.validasi END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kunjungan_pasien_baru_v]");
    }
};
