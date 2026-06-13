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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_pasien_poli_v
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jumlah, DAY(dbo.tc_registrasi.tgl_jam_masuk) AS tgl, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, 
                      YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, dbo.mt_bagian.nama_bagian, dbo.pl_tc_poli.kode_bagian, dbo.tc_kunjungan.no_registrasi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                      dbo.mt_nasabah ON dbo.tc_registrasi.kode_kelompok = dbo.mt_nasabah.kode_kelompok INNER JOIN
                      dbo.mt_bagian ON dbo.pl_tc_poli.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.pl_tc_poli.status_bayar IS NULL) AND (dbo.pl_tc_poli.status_periksa IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND 
                      (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.pl_tc_poli.no_antrian > 0) OR
                      (dbo.pl_tc_poli.status_periksa = 0)
GROUP BY DAY(dbo.tc_registrasi.tgl_jam_masuk), MONTH(dbo.tc_registrasi.tgl_jam_masuk), YEAR(dbo.tc_registrasi.tgl_jam_masuk), dbo.mt_bagian.nama_bagian, 
                      dbo.pl_tc_poli.kode_bagian, dbo.tc_kunjungan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_pasien_poli_v]");
    }
};
