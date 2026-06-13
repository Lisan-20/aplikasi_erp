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
        DB::statement("CREATE VIEW dbo.hand_over_pasien_masih_dirawat_v
AS
SELECT     dbo.pasien_masih_dirawat_v.no_registrasi, dbo.tc_cppt_max_v.hp_s, dbo.tc_cppt_max_v.hp_o, dbo.tc_cppt_max_v.hp_a, dbo.tc_cppt_max_v.hp_p, dbo.tc_cppt_max_v.tgl_jam, 
                      dbo.pasien_masih_dirawat_v.nama_pasien, dbo.pasien_masih_dirawat_v.tgl_masuk, dbo.pasien_masih_dirawat_v.dr_merawat, dbo.pasien_masih_dirawat_v.no_mr, 
                      dbo.pasien_masih_dirawat_v.no_kunjungan, dbo.pasien_masih_dirawat_v.kode_ri, dbo.pasien_masih_dirawat_v.kode_ruangan, dbo.pasien_masih_dirawat_v.bag_pas, 
                      dbo.pasien_masih_dirawat_v.kelas_pas, dbo.pasien_masih_dirawat_v.asal_pasien, dbo.pasien_masih_dirawat_v.bag_ibu, dbo.pasien_masih_dirawat_v.kelas_ibu, 
                      dbo.pasien_masih_dirawat_v.gol_darah, dbo.pasien_masih_dirawat_v.alergi, dbo.pasien_masih_dirawat_v.tgl_lhr, dbo.pasien_masih_dirawat_v.jen_kelamin, 
                      dbo.pasien_masih_dirawat_v.almt_ttp_pasien, dbo.pasien_masih_dirawat_v.tgl_keluar, dbo.pasien_masih_dirawat_v.status_pulang, dbo.pasien_masih_dirawat_v.status_cuti, 
                      dbo.pasien_masih_dirawat_v.status_registrasi, dbo.pasien_masih_dirawat_v.kode_perusahaan, dbo.pasien_masih_dirawat_v.kode_kelompok, dbo.pasien_masih_dirawat_v.no_jkn, 
                      dbo.pasien_masih_dirawat_v.plafon_bpjs, dbo.pasien_masih_dirawat_v.kode_plafon, dbo.pasien_masih_dirawat_v.diagnosa_awal, dbo.pasien_masih_dirawat_v.icd10, 
                      dbo.pasien_masih_dirawat_v.icd9, dbo.pasien_masih_dirawat_v.jatah_klas, dbo.pasien_masih_dirawat_v.kode_dokter, dbo.pasien_masih_dirawat_v.nama_pegawai, 
                      dbo.pasien_masih_dirawat_v.status_batal, dbo.pasien_masih_dirawat_v.nama_bagian, dbo.pasien_masih_dirawat_v.nama_klas, dbo.pasien_masih_dirawat_v.umur, 
                      dbo.pasien_masih_dirawat_v.alamat, dbo.pasien_masih_dirawat_v.tgl_pulang, dbo.tc_cppt_max_dok_v.hp_s AS dok_hp_s, dbo.tc_cppt_max_dok_v.hp_o AS dok_hp_o, 
                      dbo.tc_cppt_max_dok_v.hp_a AS dok_hp_a, dbo.tc_cppt_max_dok_v.hp_p AS dok_hp_p, dbo.tc_cppt_max_dok_v.tgl_jam AS dok_tgl_jam, dbo.tc_cppt_max_v.instruksi, 
                      dbo.tc_cppt_max_dok_v.instruksi AS dok_instruksi, dbo.tc_cppt_max_dok_v.Id_dok, dbo.tc_cppt_max_v.Id_per
FROM         dbo.pasien_masih_dirawat_v LEFT OUTER JOIN
                      dbo.tc_cppt_max_dok_v ON dbo.pasien_masih_dirawat_v.no_registrasi = dbo.tc_cppt_max_dok_v.no_registrasi LEFT OUTER JOIN
                      dbo.tc_cppt_max_v ON dbo.pasien_masih_dirawat_v.no_registrasi = dbo.tc_cppt_max_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hand_over_pasien_masih_dirawat_v]");
    }
};
