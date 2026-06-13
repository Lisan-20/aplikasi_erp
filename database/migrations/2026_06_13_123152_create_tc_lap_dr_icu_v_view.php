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
        DB::statement("CREATE VIEW dbo.tc_lap_dr_icu_v
AS
SELECT     YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_dokter, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.kode_kelompok, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_batal, dbo.mt_master_pasien.jen_kelamin
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY YEAR(dbo.tc_kunjungan.tgl_keluar), MONTH(dbo.tc_kunjungan.tgl_keluar), DAY(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.tc_kunjungan.kode_dokter, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.kode_kelompok, 
                      dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_batal, dbo.mt_master_pasien.jen_kelamin
HAVING      (dbo.tc_kunjungan.kode_bagian_tujuan = '031001') AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_dokter = '5') AND 
                      (NOT (YEAR(dbo.tc_kunjungan.tgl_keluar) IS NULL)) AND (NOT (MONTH(dbo.tc_kunjungan.tgl_keluar) IS NULL)) AND (NOT (DAY(dbo.tc_kunjungan.tgl_keluar) IS NULL))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_dr_icu_v]");
    }
};
