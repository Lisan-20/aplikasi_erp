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
        DB::statement("CREATE OR ALTER VIEW dbo.dokter_igd_inap_v
AS
SELECT     DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, dbo.tc_kunjungan.no_kunjungan, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_dokter, dbo.tc_registrasi.stat_pasien, 
                      dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.kode_kelompok, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.mt_karyawan.nama_pegawai, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dokter_igd_inap_v]");
    }
};
