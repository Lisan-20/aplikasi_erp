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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_bidan1_v
AS
SELECT        TOP (100) PERCENT dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_dokter_bagian.kd_bagian, dbo.mt_dokter_bagian.id_mt_dokter_bagian, dbo.mt_karyawan.flag_aktif, 
                         dbo.mt_karyawan.no_induk, dbo.mt_karyawan.kode_bidan
FROM            dbo.mt_karyawan LEFT OUTER JOIN
                         dbo.mt_bagian INNER JOIN
                         dbo.mt_dokter_bagian ON dbo.mt_bagian.kode_bagian = dbo.mt_dokter_bagian.kd_bagian ON dbo.mt_karyawan.kode_dokter = dbo.mt_dokter_bagian.kode_dokter
WHERE        (dbo.mt_karyawan.flag_aktif <> 1) AND (dbo.mt_karyawan.kode_bidan > '0')
ORDER BY dbo.mt_karyawan.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bidan1_v]");
    }
};
