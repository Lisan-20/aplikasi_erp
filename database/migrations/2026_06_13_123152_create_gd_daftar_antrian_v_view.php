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
        DB::statement("CREATE VIEW dbo.gd_daftar_antrian_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.no_mr, dbo.tc_kunjungan.no_kunjungan, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.almt_ttp_pasien, dbo.tc_kunjungan.no_registrasi, 
                      dbo.gd_tc_gawat_darurat.kode_gd, dbo.mt_master_pasien.no_ktp, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.mt_master_pasien.jen_kelamin, dbo.gd_tc_gawat_darurat.no_induk, 
                      dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.kode_penanggung, dbo.tc_kunjungan.kode_dokter, dbo.tc_registrasi.noSep, dbo.tc_kunjungan.status_keluar, dbo.tc_kunjungan.status_triase, 
                      dbo.tc_registrasi.id_triase_identitas, dbo.tc_registrasi.st_ass_dr_igd, dbo.tc_registrasi.st_kll, dbo.tc_registrasi.st_serah_terima, dbo.tc_registrasi.ttd, dbo.tc_registrasi.ttd_ri
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.tc_kunjungan ON dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr AND dbo.mt_master_pasien.no_mr = dbo.tc_kunjungan.no_mr INNER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_kunjungan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi
WHERE     (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '02%') AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gd_daftar_antrian_v]");
    }
};
