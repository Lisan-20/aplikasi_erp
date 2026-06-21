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
        DB::statement("CREATE OR ALTER VIEW dbo.dash_pendahtaran_sum2_2v
AS
SELECT     YEAR(dbo.lap_kunjungan_pasien_v.tgl_masuk) AS thn, MONTH(dbo.lap_kunjungan_pasien_v.tgl_masuk) AS bln, DAY(dbo.lap_kunjungan_pasien_v.tgl_masuk) AS tgl, 
                      dbo.mt_bagian.nama_bagian, COUNT(dbo.lap_kunjungan_pasien_v.no_kunjungan) AS jml, dbo.lap_kunjungan_pasien_v.status_batal, dbo.mt_bagian.validasi, 
                      dbo.lap_kunjungan_pasien_v.kode_bagian_masuk AS kode_bagian
FROM         dbo.lap_kunjungan_pasien_v INNER JOIN
                      dbo.mt_bagian ON dbo.lap_kunjungan_pasien_v.kode_bagian_masuk = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.lap_kunjungan_pasien_v.no_induk = dbo.mt_karyawan.no_induk
GROUP BY YEAR(dbo.lap_kunjungan_pasien_v.tgl_masuk), MONTH(dbo.lap_kunjungan_pasien_v.tgl_masuk), DAY(dbo.lap_kunjungan_pasien_v.tgl_masuk), 
                      dbo.mt_bagian.nama_bagian, dbo.lap_kunjungan_pasien_v.status_batal, dbo.mt_bagian.validasi, dbo.lap_kunjungan_pasien_v.kode_bagian_masuk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dash_pendahtaran_sum2_2v]");
    }
};
