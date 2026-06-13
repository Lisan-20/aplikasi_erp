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
        DB::statement("CREATE VIEW dbo.permintaan_RI_pasien_v
AS
SELECT     dbo.rg_master_pasien_v.id_mt_master_pasien, dbo.rg_master_pasien_v.no_mr, dbo.rg_master_pasien_v.hubungan, dbo.rg_master_pasien_v.no_urutan, dbo.rg_master_pasien_v.kode_login, 
                      dbo.rg_master_pasien_v.kota, dbo.rg_master_pasien_v.nama_pasien, dbo.rg_master_pasien_v.nama_panggilan, dbo.rg_master_pasien_v.nama_kel_pasien, dbo.rg_master_pasien_v.no_ktp, 
                      dbo.rg_master_pasien_v.pekerjaan, dbo.rg_master_pasien_v.tgl_lhr, dbo.rg_master_pasien_v.tempat_lahir, dbo.rg_master_pasien_v.umur_pasien, dbo.rg_master_pasien_v.almt_ttp_pasien, 
                      dbo.rg_master_pasien_v.tlp_almt_ttp, dbo.rg_master_pasien_v.jen_kelamin, dbo.rg_master_pasien_v.status_perkaw, dbo.rg_master_pasien_v.suku, dbo.rg_master_pasien_v.kode_agama, 
                      dbo.rg_master_pasien_v.kebangsaan, dbo.rg_master_pasien_v.alamat_lokal, dbo.rg_master_pasien_v.tlp_almt_lkl, dbo.rg_master_pasien_v.nama_kel_ter, 
                      dbo.rg_master_pasien_v.nama_almt_kel, dbo.rg_master_pasien_v.hubungan_kel, dbo.rg_master_pasien_v.tlp_kel, dbo.rg_master_pasien_v.kode_pendidikan, 
                      dbo.rg_master_pasien_v.kode_kelompok, dbo.rg_master_pasien_v.kode_perusahaan, dbo.rg_master_pasien_v.kd_bgn, dbo.rg_master_pasien_v.prosedur_rs, 
                      dbo.rg_master_pasien_v.nama_almt_kantor, dbo.rg_master_pasien_v.jabatan, dbo.rg_master_pasien_v.gol_darah, dbo.rg_master_pasien_v.alergi, dbo.rg_master_pasien_v.nama_ayah, 
                      dbo.rg_master_pasien_v.umur_ayah, dbo.rg_master_pasien_v.pekerjaan_ayah, dbo.rg_master_pasien_v.nama_ibu, dbo.rg_master_pasien_v.umur_ibu, dbo.rg_master_pasien_v.pekerjaan_ibu, 
                      dbo.rg_master_pasien_v.no_askes, dbo.rg_master_pasien_v.nm_inst_askes, dbo.rg_master_pasien_v.tgl_ctk_kartu, dbo.rg_master_pasien_v.jth_kelas, dbo.rg_master_pasien_v.masa_mulai, 
                      dbo.rg_master_pasien_v.masa_selesai, dbo.rg_master_pasien_v.flag_member, dbo.rg_master_pasien_v.jam_lahir, dbo.rg_master_pasien_v.berat_badan, 
                      dbo.rg_master_pasien_v.panjang_badan, dbo.rg_master_pasien_v.warna_kulit, dbo.rg_master_pasien_v.no_gelang, dbo.rg_master_pasien_v.pemberi_no, dbo.rg_master_pasien_v.mr_ibu, 
                      dbo.rg_master_pasien_v.dok_penolong, dbo.rg_master_pasien_v.user_id, dbo.rg_master_pasien_v.penanggung, dbo.rg_master_pasien_v.kode_klas, dbo.rg_master_pasien_v.milik, 
                      dbo.rg_master_pasien_v.status_meninggal, dbo.rg_master_pasien_v.tgl_input, dbo.rg_master_pasien_v.jatah_ruang, dbo.rg_master_pasien_v.id_dc_kota, 
                      dbo.rg_master_pasien_v.id_dc_kecamatan, dbo.rg_master_pasien_v.id_dc_kelurahan, dbo.rg_master_pasien_v.tlp_almt_ttp1, dbo.rg_master_pasien_v.field_sem1, 
                      dbo.rg_master_pasien_v.field_sem2, dbo.rg_master_pasien_v.field_sem3, dbo.rg_master_pasien_v.field_sem4, dbo.rg_master_pasien_v.field_sem5, dbo.rg_master_pasien_v.field_sem6, 
                      dbo.rg_master_pasien_v.field_sem7, dbo.rg_master_pasien_v.field_sem8, dbo.rg_master_pasien_v.field_sem9, dbo.rg_master_pasien_v.field_sem10, dbo.rg_master_pasien_v.nasabah, 
                      dbo.rg_master_pasien_v.perusahaan, dbo.rg_master_pasien_v.kode_p, dbo.rg_master_pasien_v.kode_pt, dbo.rg_master_pasien_v.nik, dbo.rg_master_pasien_v.wil_krj, 
                      dbo.rg_master_pasien_v.nama_pt, dbo.rg_master_pasien_v.status_aktif, dbo.rg_master_pasien_v.blacklist, dbo.rg_master_pasien_v.memo, dbo.rg_master_pasien_v.alasan_blokir, 
                      dbo.tc_emr_form.no_mr AS Expr1, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.kode_rm, dbo.tc_emr_form.tgl_update, dbo.tc_emr_form.id_user, 
                      dbo.tc_emr_form.kode_bagian, dbo.tc_registrasi.tgl_jam_keluar, dbo.mt_bagian.nama_bagian, dbo.tc_emr_form.flag_respon, dbo.tc_emr_form.tgl_jam_respon, dbo.tc_emr_form.id_user_respon, 
                      dbo.rg_tc_rujukan_v.kode_rujukan, dbo.rg_tc_rujukan_v.status, dbo.tc_registrasi.kode_penanggung, dbo.rg_tc_rujukan_v.rujukan_dari
FROM         dbo.rg_master_pasien_v INNER JOIN
                      dbo.tc_emr_form ON dbo.rg_master_pasien_v.no_mr = dbo.tc_emr_form.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_emr_form.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.rg_tc_rujukan_v ON dbo.tc_registrasi.no_registrasi = dbo.rg_tc_rujukan_v.no_registrasi
WHERE     (dbo.tc_emr_form.kode_rm = 65)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [permintaan_RI_pasien_v]");
    }
};
