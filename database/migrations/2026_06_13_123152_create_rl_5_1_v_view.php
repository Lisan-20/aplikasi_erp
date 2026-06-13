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
        DB::statement("
CREATE VIEW [dbo].[rl_5_1_v]
AS
SELECT     dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_kunjungan.tgl_masuk) AS bln, dbo.tc_registrasi.status_batal, YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn, dbo.tc_kunjungan.status_batal AS status_batl, 
                      COUNT(dbo.tc_kunjungan.no_registrasi) AS jumlah, dbo.mt_bagian.status_aktif, dbo.mt_bagian.validasi_lap_rm, dbo.mt_bagian.validasi, dbo.tc_kunjungan.kode_bagian_tujuan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_kunjungan.tgl_masuk), dbo.tc_registrasi.status_batal, YEAR(dbo.tc_kunjungan.tgl_masuk), dbo.tc_kunjungan.status_batal, 
                      dbo.mt_bagian.status_aktif, dbo.mt_bagian.validasi_lap_rm, dbo.mt_bagian.validasi, dbo.tc_kunjungan.kode_bagian_tujuan
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.mt_bagian.status_aktif = 1) AND (NOT (dbo.mt_bagian.validasi_lap_rm IS NULL))

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_5_1_v]");
    }
};
