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
        DB::statement("CREATE VIEW dbo.data_pokok_pegawai_calon_v
AS
SELECT     TOP (100) PERCENT dbo.mt_karyawan_calon.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan_calon.status, dbo.mt_karyawan_calon.id_status, 
                      dbo.mt_karyawan_calon.id_dc_kawin, dbo.mt_karyawan_calon.id_sex, dbo.mt_karyawan_calon.tlp, dbo.mt_karyawan_calon.alamat, dbo.mt_karyawan_calon.tmp_lahir, 
                      dbo.mt_karyawan_calon.tgl_lahir, dbo.dc_sex.sex AS jen_kelamin, dbo.dc_agama.agama, dbo.mt_karyawan_calon.tinggi_Badan, dbo.mt_karyawan_calon.berat_badan, 
                      dbo.mt_karyawan_calon.gol_darah, dbo.mt_karyawan_calon.suku, dbo.mt_karyawan_calon.kota, dbo.mt_karyawan_calon.propinsi, dbo.mt_karyawan_calon.kode_bagian, 
                      dbo.mt_karyawan_calon.nama_panggilan, dbo.mt_karyawan_calon.no_ktp, dbo.mt_karyawan_calon.id_calon, dbo.mt_karyawan_calon.no_induk_calon, dbo.dc_agama.id_dc_agama, 
                      dbo.mt_karyawan_calon.keterangan, dbo.mt_karyawan_calon.tgl_tes
FROM         dbo.dc_agama RIGHT OUTER JOIN
                      dbo.mt_karyawan_calon ON dbo.dc_agama.id_dc_agama = dbo.mt_karyawan_calon.id_dc_agama LEFT OUTER JOIN
                      dbo.dc_sex ON dbo.mt_karyawan_calon.id_sex = dbo.dc_sex.id_dc_sex LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan_calon.kode_bagian = dbo.mt_bagian.kode_bagian
ORDER BY dbo.mt_karyawan_calon.nama_pegawai
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pokok_pegawai_calon_v]");
    }
};
