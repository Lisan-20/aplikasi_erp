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
        DB::statement("CREATE OR ALTER VIEW dbo.hand_over_pasien_shift_v
AS
SELECT     dbo.tc_hand_over_shift.no_urut, dbo.tc_hand_over_shift.kode_shift, dbo.tc_hand_over_shift.no_induk_kirim, dbo.tc_hand_over_shift.no_induk_terima, dbo.tc_hand_over_shift.tgl_jam, 
                      dbo.tc_hand_over_shift.no_mr, dbo.tc_hand_over_shift.no_registrasi, dbo.tc_hand_over_shift.no_kunjungan, dbo.hand_over_pasien_masih_dirawat_v.nama_pasien, 
                      dbo.hand_over_pasien_masih_dirawat_v.tgl_masuk, dbo.hand_over_pasien_masih_dirawat_v.dr_merawat, dbo.hand_over_pasien_masih_dirawat_v.no_mr AS Expr1, 
                      dbo.hand_over_pasien_masih_dirawat_v.no_kunjungan AS Expr2, dbo.hand_over_pasien_masih_dirawat_v.kode_ri, dbo.hand_over_pasien_masih_dirawat_v.kode_ruangan, 
                      dbo.hand_over_pasien_masih_dirawat_v.bag_pas, dbo.hand_over_pasien_masih_dirawat_v.kelas_pas, dbo.hand_over_pasien_masih_dirawat_v.asal_pasien, 
                      dbo.hand_over_pasien_masih_dirawat_v.bag_ibu, dbo.hand_over_pasien_masih_dirawat_v.kelas_ibu, dbo.hand_over_pasien_masih_dirawat_v.gol_darah, 
                      dbo.hand_over_pasien_masih_dirawat_v.alergi, dbo.hand_over_pasien_masih_dirawat_v.tgl_lhr, dbo.hand_over_pasien_masih_dirawat_v.jen_kelamin, 
                      dbo.hand_over_pasien_masih_dirawat_v.almt_ttp_pasien, dbo.hand_over_pasien_masih_dirawat_v.tgl_keluar, dbo.hand_over_pasien_masih_dirawat_v.status_pulang, 
                      dbo.hand_over_pasien_masih_dirawat_v.status_cuti, dbo.hand_over_pasien_masih_dirawat_v.status_registrasi, dbo.hand_over_pasien_masih_dirawat_v.kode_perusahaan, 
                      dbo.hand_over_pasien_masih_dirawat_v.kode_kelompok, dbo.hand_over_pasien_masih_dirawat_v.no_jkn, dbo.hand_over_pasien_masih_dirawat_v.plafon_bpjs, 
                      dbo.hand_over_pasien_masih_dirawat_v.kode_plafon, dbo.hand_over_pasien_masih_dirawat_v.diagnosa_awal, dbo.hand_over_pasien_masih_dirawat_v.icd10, 
                      dbo.hand_over_pasien_masih_dirawat_v.icd9, dbo.hand_over_pasien_masih_dirawat_v.jatah_klas, dbo.hand_over_pasien_masih_dirawat_v.kode_dokter, 
                      dbo.hand_over_pasien_masih_dirawat_v.umur, dbo.hand_over_pasien_masih_dirawat_v.alamat, dbo.hand_over_pasien_masih_dirawat_v.nama_pegawai, 
                      dbo.hand_over_pasien_masih_dirawat_v.status_batal, dbo.hand_over_pasien_masih_dirawat_v.nama_bagian, dbo.hand_over_pasien_masih_dirawat_v.nama_klas, 
                      dbo.hand_over_pasien_masih_dirawat_v.tgl_pulang, dbo.tc_hand_over_shift.Id_per, dbo.tc_hand_over_shift.Id_dok, dbo.tc_cppt_perawat_v.hp_s, dbo.tc_cppt_perawat_v.hp_o, 
                      dbo.tc_cppt_perawat_v.hp_a, dbo.tc_cppt_perawat_v.hp_p, dbo.tc_cppt_perawat_v.instruksi, dbo.tc_cppt_dok_v.hp_s AS dok_hp_s, dbo.tc_cppt_dok_v.hp_o AS dok_hp_o, 
                      dbo.tc_cppt_dok_v.hp_a AS dok_hp_a, dbo.tc_cppt_dok_v.hp_p AS dok_hp_p, dbo.tc_cppt_dok_v.instruksi AS dok_instruksi, dbo.tc_hand_over_shift.notes
FROM         dbo.tc_hand_over_shift INNER JOIN
                      dbo.hand_over_pasien_masih_dirawat_v ON dbo.tc_hand_over_shift.no_registrasi = dbo.hand_over_pasien_masih_dirawat_v.no_registrasi LEFT OUTER JOIN
                      dbo.tc_cppt_dok_v ON dbo.tc_hand_over_shift.no_kunjungan = dbo.tc_cppt_dok_v.no_registrasi AND dbo.tc_hand_over_shift.Id_dok = dbo.tc_cppt_dok_v.Id_dok LEFT OUTER JOIN
                      dbo.tc_cppt_perawat_v ON dbo.tc_hand_over_shift.no_registrasi = dbo.tc_cppt_perawat_v.no_registrasi AND dbo.tc_hand_over_shift.Id_per = dbo.tc_cppt_perawat_v.Id_per
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hand_over_pasien_shift_v]");
    }
};
