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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_LP_v
AS
SELECT     COUNT(a.no_registrasi) AS jml_pas, a.umur, dbo.mt_bagian.validasi_lap_rm, DAY(c.tgl_masuk) AS tgl, MONTH(c.tgl_masuk) AS bln, YEAR(c.tgl_masuk) AS thn, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_bagian.nama_bagian, a.stat_pasien, dbo.ri_tc_rawatinap.kelas_pas, a.kode_kelompok, c.no_mr, a.no_registrasi, 
                      c.no_kunjungan, c.kode_bagian_tujuan, c.kode_bagian_asal
FROM         dbo.ri_tc_rawatinap RIGHT OUTER JOIN
                      dbo.tc_registrasi AS a INNER JOIN
                      dbo.tc_kunjungan AS c ON a.no_registrasi = c.no_registrasi INNER JOIN
                      dbo.mt_bagian ON c.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON a.no_mr = dbo.mt_master_pasien.no_mr ON dbo.ri_tc_rawatinap.no_kunjungan = c.no_kunjungan
WHERE     (c.status_batal IS NULL) AND (c.flag_titipan IS NULL OR
                      c.flag_titipan = 2) AND (a.status_batal IS NULL)
GROUP BY c.kode_bagian_tujuan, dbo.mt_bagian.validasi_lap_rm, DAY(c.tgl_masuk), MONTH(c.tgl_masuk), YEAR(c.tgl_masuk), a.umur, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_bagian.nama_bagian, a.stat_pasien, dbo.ri_tc_rawatinap.kelas_pas, a.kode_kelompok, c.no_mr, a.no_registrasi, c.no_kunjungan, c.kode_bagian_asal
HAVING      (c.kode_bagian_tujuan LIKE '03%' AND NOT (c.kode_bagian_tujuan LIKE '030001'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_LP_v]");
    }
};
