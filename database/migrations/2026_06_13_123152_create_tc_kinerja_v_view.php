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
        DB::statement("CREATE VIEW dbo.tc_kinerja_v
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.tc_penilaian_kinerja.id_tc_kinerja, dbo.tc_penilaian_kinerja.npp, dbo.tc_penilaian_kinerja.komentar_pegawai, dbo.tc_penilaian_kinerja.komentar_penilai, 
                      dbo.tc_penilaian_kinerja.komentar_atasan, dbo.tc_penilaian_kinerja.npp_penilai, dbo.tc_penilaian_kinerja.npp_atasan, dbo.tc_penilaian_kinerja.kelompok_kinerja, 
                      dbo.tc_penilaian_kinerja.tgl_penilaian, dbo.tc_penilaian_kinerja.input_id, dbo.tc_penilaian_kinerja.input_tgl, dbo.tc_penilaian_kinerja.status, dbo.tc_penilaian_kinerja.status_tgl, 
                      dbo.tc_penilaian_kinerja.id_per_penilaian, dbo.tc_penilaian_kinerja_det.jml_bobot, dbo.tc_penilaian_kinerja_det.total_nilai, dbo.tc_penilaian_kinerja_det.resume, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_jabatan.nama_jabatan, dbo.tc_penilaian_kinerja_det.id_kinerja_det, dbo.tc_penilaian_kinerja_det.nilai_bobot, dbo.tc_penilaian_kinerja_det.nilai, dbo.mt_kinerja_penilaian.id_bobot
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tc_penilaian_kinerja ON dbo.mt_karyawan.npp = dbo.tc_penilaian_kinerja.npp INNER JOIN
                      dbo.tc_penilaian_kinerja_det ON dbo.tc_penilaian_kinerja.id_tc_kinerja = dbo.tc_penilaian_kinerja_det.id_tc_kinerja INNER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan.kode_jabatan = dbo.mt_jabatan.kode_jabatan INNER JOIN
                      dbo.mt_kinerja_penilaian_det ON dbo.tc_penilaian_kinerja_det.id_kinerja_det = dbo.mt_kinerja_penilaian_det.id_kinerja_det INNER JOIN
                      dbo.mt_kinerja_penilaian ON dbo.mt_kinerja_penilaian_det.id_kinerja = dbo.mt_kinerja_penilaian.id_kinerja
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kinerja_v]");
    }
};
