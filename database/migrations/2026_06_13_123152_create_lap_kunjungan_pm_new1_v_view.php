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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_pm_new1_v
AS
SELECT     TOP (100) PERCENT COUNT(a.no_registrasi) AS jml_pas, DAY(c.tgl_masuk) AS tgl, MONTH(c.tgl_masuk) AS bln, YEAR(c.tgl_masuk) AS thn, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_bagian.kode_bagian
FROM         dbo.tc_registrasi AS a INNER JOIN
                      dbo.tc_kunjungan AS c ON a.no_registrasi = c.no_registrasi INNER JOIN
                      dbo.mt_bagian ON c.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON a.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.pm_tc_penunjang ON c.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan
WHERE     (c.status_batal IS NULL)
GROUP BY a.status_batal, DAY(c.tgl_masuk), MONTH(c.tgl_masuk), YEAR(c.tgl_masuk), dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_bagian
HAVING      (a.status_batal IS NULL) AND (MONTH(c.tgl_masuk) = 1) AND (YEAR(c.tgl_masuk) = 2023)
ORDER BY tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_new1_v]");
    }
};
