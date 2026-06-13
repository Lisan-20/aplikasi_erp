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
        DB::statement("CREATE VIEW dbo.sensus_rm_igd_v
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk, 
                      dbo.tc_registrasi.stat_pasien, dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.gd_tc_gawat_darurat.no_kunjungan, dbo.gd_tc_gawat_darurat.dokter_jaga, dbo.mt_bagian.kode_bagian, dbo.tc_registrasi.status_batal, 
                      dbo.tc_registrasi.status_registrasi
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_kunjungan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.gd_tc_gawat_darurat.dokter_jaga = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.pelayanan_vw ON dbo.gd_tc_gawat_darurat.no_kunjungan = dbo.pelayanan_vw.no_kunjungan CROSS JOIN
                      dbo.mt_bagian
GROUP BY dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk, dbo.tc_registrasi.stat_pasien, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.gd_tc_gawat_darurat.no_kunjungan, dbo.gd_tc_gawat_darurat.dokter_jaga, dbo.mt_bagian.kode_bagian, dbo.tc_registrasi.status_batal, 
                      dbo.tc_registrasi.status_registrasi
HAVING      (dbo.mt_bagian.kode_bagian = '020101') AND (dbo.tc_registrasi.status_batal IS NULL)
ORDER BY dbo.gd_tc_gawat_darurat.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_rm_igd_v]");
    }
};
