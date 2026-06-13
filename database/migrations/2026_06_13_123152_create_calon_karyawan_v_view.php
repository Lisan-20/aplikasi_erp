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
        DB::statement("CREATE VIEW dbo.calon_karyawan_v
AS
SELECT     TOP (100) PERCENT dbo.mt_karyawan_calon.nama_pegawai, dbo.jawaban_semua_soal_v.no_peserta, dbo.jawaban_semua_soal_v.nama_bagian, dbo.jawaban_semua_soal_v.id_tipe, 
                      dbo.jawaban_semua_soal_v.nilai_tes_msk
FROM         dbo.jawaban_semua_soal_v INNER JOIN
                      dbo.mt_karyawan_calon ON dbo.jawaban_semua_soal_v.no_peserta = dbo.mt_karyawan_calon.id_calon
GROUP BY dbo.mt_karyawan_calon.nama_pegawai, dbo.jawaban_semua_soal_v.no_peserta, dbo.jawaban_semua_soal_v.nama_bagian, dbo.jawaban_semua_soal_v.id_tipe, 
                      dbo.jawaban_semua_soal_v.nilai_tes_msk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [calon_karyawan_v]");
    }
};
