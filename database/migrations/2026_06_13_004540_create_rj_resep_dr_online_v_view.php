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
        DB::statement("CREATE OR ALTER VIEW dbo.rj_resep_dr_online_v
AS
SELECT DISTINCT 
                      dbo.rj_mt_pasien_v.no_mr, dbo.rj_mt_pasien_v.nama_pasien, dbo.rj_mt_pasien_v.tgl_lhr, dbo.rj_mt_pasien_v.kode_agama, dbo.rj_mt_pasien_v.kode_pendidikan, 
                      dbo.rj_mt_pasien_v.no_registrasi, dbo.rj_mt_pasien_v.gol_darah, dbo.rj_mt_pasien_v.tgl_masuk, dbo.rj_mt_pasien_v.tgl_keluar, dbo.rj_mt_pasien_v.nama_bagian, 
                      dbo.rj_mt_pasien_v.nama_pegawai, dbo.rj_mt_pasien_v.kode_bagian, dbo.rj_mt_pasien_v.status_keluar, dbo.rj_mt_pasien_v.kode_dokter, 
                      dbo.rj_mt_pasien_v.no_kunjungan, dbo.rj_mt_pasien_v.kode_gd, dbo.rj_mt_pasien_v.kode_kelompok, dbo.rj_mt_pasien_v.kode_perusahaan
FROM         dbo.tc_resep_dokter INNER JOIN
                      dbo.rj_mt_pasien_v ON dbo.tc_resep_dokter.no_registrasi = dbo.rj_mt_pasien_v.no_registrasi AND 
                      dbo.tc_resep_dokter.no_kunjungan = dbo.rj_mt_pasien_v.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rj_resep_dr_online_v]");
    }
};
