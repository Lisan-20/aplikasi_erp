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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kinerja_view_v
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.tc_penilaian_kinerja.id_tc_kinerja, dbo.tc_penilaian_kinerja.npp, dbo.tc_penilaian_kinerja.komentar_pegawai, dbo.tc_penilaian_kinerja.komentar_penilai, 
                      dbo.tc_penilaian_kinerja.komentar_atasan, dbo.tc_penilaian_kinerja.npp_penilai, dbo.tc_penilaian_kinerja.npp_atasan, dbo.tc_penilaian_kinerja.kelompok_kinerja, 
                      dbo.tc_penilaian_kinerja.tgl_penilaian, dbo.tc_penilaian_kinerja.input_id, dbo.tc_penilaian_kinerja.input_tgl, dbo.tc_penilaian_kinerja.status, dbo.tc_penilaian_kinerja.status_tgl, 
                      dbo.tc_penilaian_kinerja.id_per_penilaian, dbo.mt_bagian.nama_bagian, dbo.mt_jabatan.nama_jabatan
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_penilaian_kinerja ON dbo.mt_karyawan.npp = dbo.tc_penilaian_kinerja.npp INNER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan.kode_jabatan = dbo.mt_jabatan.kode_jabatan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kinerja_view_v]");
    }
};
