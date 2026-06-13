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
        DB::statement("CREATE VIEW dbo.lap_rm_rajal_igd_v
AS
SELECT     dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk, dbo.tc_registrasi.stat_pasien, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.gd_tc_gawat_darurat.kode_gd, dbo.gd_tc_gawat_darurat.dokter_jaga, dbo.mt_bagian.kode_bagian
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_kunjungan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.gd_tc_gawat_darurat.dokter_jaga = dbo.mt_karyawan.kode_dokter CROSS JOIN
                      dbo.mt_bagian
WHERE     (dbo.tc_registrasi.status_registrasi = 1) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.mt_bagian.kode_bagian = '020101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rm_rajal_igd_v]");
    }
};
