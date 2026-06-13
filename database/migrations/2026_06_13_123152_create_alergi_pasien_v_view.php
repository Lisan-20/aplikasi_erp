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
        DB::statement("CREATE VIEW dbo.alergi_pasien_v
AS
SELECT     TOP (100) PERCENT dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_dokter.hasil, dbo.tc_pemeriksaan_dokter.no_kunjungan, dbo.mt_acc_erm.kd_type, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_kunjungan.tgl_masuk AS tgl_jam, dbo.tc_kunjungan.kode_dokter, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_dokter.hasil2, 
                      dbo.tc_pemeriksaan_dokter.kode_pemeriksaan
FROM         dbo.tc_pemeriksaan_dokter INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_dokter.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_dokter.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_kunjungan.kode_dokter = dbo.mt_karyawan.kode_dokter
GROUP BY dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_dokter.hasil, dbo.tc_pemeriksaan_dokter.no_kunjungan, dbo.mt_acc_erm.kd_type, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.kode_dokter, dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_dokter.hasil2, 
                      dbo.tc_pemeriksaan_dokter.kode_pemeriksaan
HAVING      (dbo.mt_acc_erm.nama_pemeriksaan LIKE '%Alergi%') AND (dbo.mt_acc_erm.kd_type = 5) AND (dbo.tc_pemeriksaan_dokter.hasil <> '') AND (dbo.tc_pemeriksaan_dokter.hasil <> 'Tidak') AND 
                      (dbo.tc_pemeriksaan_dokter.hasil <> '-')
ORDER BY tgl_jam DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [alergi_pasien_v]");
    }
};
