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
        DB::statement("CREATE VIEW dbo.jawaban_semua_soal_v
AS
SELECT     dbo.tc_jawab_soal.no_peserta, dbo.tc_jawab_soal.id_mt_soal, dbo.tc_jawab_soal.jawaban, dbo.tc_jawab_soal.id_tipe, dbo.tc_jawab_soal.no_urut, dbo.mt_karyawan_calon.nama_pegawai, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bank_soal_det.detail_soal, dbo.mt_karyawan_calon.nilai_tes_msk
FROM         dbo.mt_karyawan_calon INNER JOIN
                      dbo.tc_jawab_soal ON dbo.mt_karyawan_calon.id_calon = dbo.tc_jawab_soal.no_peserta INNER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan_calon.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_bank_soal_det ON dbo.tc_jawab_soal.id_mt_bank_soal_det = dbo.mt_bank_soal_det.id_mt_bank_soal_det
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jawaban_semua_soal_v]");
    }
};
