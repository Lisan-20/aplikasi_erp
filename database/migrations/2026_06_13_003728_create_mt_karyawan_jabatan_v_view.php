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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_karyawan_jabatan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_karyawan.no_induk, dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.npp, dbo.mt_karyawan.ttd, dbo.mt_karyawan.kode_bagian, dbo.mt_karyawan.kode_jabatan, 
                      dbo.mt_jabatan.kd_st, dbo.mt_jabatan.ref_jab, dbo.mt_jabatan.lev_jab, dbo.mt_jabatan.nama_jabatan, dbo.mt_jabatan.kode_kel_kerja, dbo.mt_karyawan.id_status
FROM         dbo.mt_karyawan LEFT OUTER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan.kode_jabatan = dbo.mt_jabatan.kode_jabatan
ORDER BY dbo.mt_karyawan.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_karyawan_jabatan_v]");
    }
};
