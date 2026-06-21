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
        DB::statement("CREATE OR ALTER VIEW dbo.sensus_pasien_batal_v
AS
SELECT     dbo.tc_kunjungan.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.pl_tc_poli.kode_poli, dbo.mt_karyawan.nama_pegawai, dbo.tc_kunjungan.tgl_masuk, 
                      dbo.tc_registrasi.stat_pasien, dbo.pl_tc_poli.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.status_batal
FROM         dbo.pl_tc_poli INNER JOIN
                      dbo.tc_kunjungan ON dbo.pl_tc_poli.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.pl_tc_poli.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_karyawan ON dbo.pl_tc_poli.kode_dokter = dbo.mt_karyawan.kode_dokter
WHERE     (dbo.tc_registrasi.status_batal IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sensus_pasien_batal_v]");
    }
};
