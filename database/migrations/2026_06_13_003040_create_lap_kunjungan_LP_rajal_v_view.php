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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_LP_rajal_v
AS
SELECT     COUNT(a.no_registrasi) AS jml_pas, a.umur, dbo.mt_bagian.validasi_lap_rm, DAY(c.tgl_masuk) AS tgl, MONTH(c.tgl_masuk) AS bln, YEAR(c.tgl_masuk) AS thn, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_bagian.nama_bagian, a.stat_pasien, a.kode_kelompok, dbo.mt_bagian.kode_bagian
FROM         dbo.tc_registrasi AS a INNER JOIN
                      dbo.tc_kunjungan AS c ON a.no_registrasi = c.no_registrasi INNER JOIN
                      dbo.mt_bagian ON c.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON a.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (c.status_batal IS NULL)
GROUP BY a.status_batal, c.kode_bagian_tujuan, dbo.mt_bagian.validasi_lap_rm, DAY(c.tgl_masuk), MONTH(c.tgl_masuk), YEAR(c.tgl_masuk), a.umur, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_bagian.nama_bagian, a.stat_pasien, a.kode_kelompok, dbo.mt_bagian.kode_bagian
HAVING      (a.status_batal IS NULL) AND (dbo.mt_bagian.validasi_lap_rm LIKE '01%') AND (NOT (c.kode_bagian_tujuan IN ('020101')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_LP_rajal_v]");
    }
};
