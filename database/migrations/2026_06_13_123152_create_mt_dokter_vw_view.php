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
        DB::statement("CREATE VIEW dbo.mt_dokter_vw
AS
SELECT     TOP (100) PERCENT dbo.mt_dokter_bagian.kode_dokter, dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_spesialisasi_dokter.nama_spesialisasi, 
                      dbo.mt_dokter_bagian.kd_bagian, dbo.mt_dokter_bagian.id_mt_dokter_bagian, dbo.mt_spesialisasi_dokter.kode_spesialisasi, dbo.mt_karyawan.flag_aktif, dbo.mt_karyawan.kode_dokter_hfis, 
                      dbo.mt_bagian.kode_poli_vclaim
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.mt_dokter_bagian ON dbo.mt_dokter_bagian.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.mt_spesialisasi_dokter ON dbo.mt_karyawan.kode_spesialisasi = dbo.mt_spesialisasi_dokter.kode_spesialisasi INNER JOIN
                      dbo.mt_bagian ON dbo.mt_bagian.kode_bagian = dbo.mt_dokter_bagian.kd_bagian
WHERE     (NOT (dbo.mt_karyawan.nama_pegawai LIKE '%BD%')) AND (dbo.mt_dokter_bagian.kd_bagian LIKE '01%') OR
                      (dbo.mt_dokter_bagian.kd_bagian = '050301')
ORDER BY dbo.mt_karyawan.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_dokter_vw]");
    }
};
