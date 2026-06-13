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
        DB::statement("CREATE VIEW dbo.data_penilaian_pokok_pegawai_calon_v
AS
SELECT     TOP (100) PERCENT dbo.mt_bagian.nama_bagian, dbo.dc_pendidikan.pendidikan, dbo.dc_riwayat_pendidikan.lokasi_sekolah, dbo.dc_riwayat_pendidikan.nama_sekolah, 
                      dbo.dc_riwayat_pendidikan.tahun_lulus, dbo.dc_sex.sex AS jen_kelamin, dbo.dc_agama.agama, dbo.dc_riwayat_pendidikan.id_dc_pendidikan, dbo.mt_karyawan_calon.id_calon, 
                      dbo.mt_karyawan_calon.nama_pegawai, dbo.mt_karyawan_calon.kode_bagian, dbo.mt_karyawan_calon.status, dbo.mt_karyawan_calon.tgl_lahir, dbo.mt_karyawan_calon.tmp_lahir, 
                      dbo.mt_karyawan_calon.id_sex, dbo.mt_karyawan_calon.tlp, dbo.mt_karyawan_calon.id_status, dbo.mt_karyawan_calon.id_dc_kawin, dbo.mt_karyawan_calon.id_dc_agama, 
                      dbo.mt_karyawan_calon.no_induk_calon
FROM         dbo.mt_bagian RIGHT OUTER JOIN
                      dbo.dc_sex RIGHT OUTER JOIN
                      dbo.mt_karyawan_calon LEFT OUTER JOIN
                      dbo.dc_agama ON dbo.mt_karyawan_calon.id_dc_agama = dbo.dc_agama.id_dc_agama LEFT OUTER JOIN
                      dbo.dc_riwayat_pendidikan INNER JOIN
                      dbo.dc_pendidikan ON dbo.dc_riwayat_pendidikan.id_dc_pendidikan = dbo.dc_pendidikan.id_dc_pendidikan ON dbo.mt_karyawan_calon.no_induk_calon = dbo.dc_riwayat_pendidikan.npp ON 
                      dbo.dc_sex.id_dc_sex = dbo.mt_karyawan_calon.id_sex ON dbo.mt_bagian.kode_bagian = dbo.mt_karyawan_calon.kode_bagian
WHERE     (NOT (dbo.mt_karyawan_calon.id_calon IN (1, 666)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_penilaian_pokok_pegawai_calon_v]");
    }
};
