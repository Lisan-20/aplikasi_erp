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
        DB::statement("CREATE VIEW dbo.rg_master_pasien_ol_v
AS
SELECT     dbo.mt_master_pasien_ol.no_mr, dbo.mt_master_pasien_ol.hubungan, dbo.mt_master_pasien_ol.no_urutan, dbo.mt_master_pasien_ol.kode_login, dbo.mt_master_pasien_ol.kota, 
                      dbo.mt_master_pasien_ol.nama_pasien, dbo.mt_master_pasien_ol.nama_panggilan, dbo.mt_master_pasien_ol.nama_kel_pasien, dbo.mt_master_pasien_ol.no_ktp, 
                      dbo.mt_master_pasien_ol.pekerjaan, dbo.mt_master_pasien_ol.tgl_lhr, dbo.mt_master_pasien_ol.tempat_lahir, dbo.mt_master_pasien_ol.umur_pasien, dbo.mt_master_pasien_ol.almt_ttp_pasien, 
                      dbo.mt_master_pasien_ol.tlp_almt_ttp, dbo.mt_master_pasien_ol.jen_kelamin, dbo.mt_master_pasien_ol.status_perkaw, dbo.mt_master_pasien_ol.suku, dbo.mt_master_pasien_ol.kode_agama, 
                      dbo.mt_master_pasien_ol.kebangsaan, dbo.mt_master_pasien_ol.alamat_lokal, dbo.mt_master_pasien_ol.tlp_almt_lkl, dbo.mt_master_pasien_ol.nama_kel_ter, 
                      dbo.mt_master_pasien_ol.nama_almt_kel, dbo.mt_master_pasien_ol.hubungan_kel, dbo.mt_master_pasien_ol.tlp_kel, dbo.mt_master_pasien_ol.kode_pendidikan, 
                      dbo.mt_master_pasien_ol.kode_kelompok, dbo.mt_master_pasien_ol.kode_perusahaan, dbo.mt_master_pasien_ol.kd_bgn, dbo.mt_master_pasien_ol.prosedur_rs, 
                      dbo.mt_master_pasien_ol.nama_almt_kantor, dbo.mt_master_pasien_ol.jabatan, dbo.mt_master_pasien_ol.gol_darah, dbo.mt_master_pasien_ol.alergi, dbo.mt_master_pasien_ol.nama_ayah, 
                      dbo.mt_master_pasien_ol.umur_ayah, dbo.mt_master_pasien_ol.pekerjaan_ayah, dbo.mt_master_pasien_ol.nama_ibu, dbo.mt_master_pasien_ol.umur_ibu, 
                      dbo.mt_master_pasien_ol.pekerjaan_ibu, dbo.mt_master_pasien_ol.no_askes, dbo.mt_master_pasien_ol.nm_inst_askes, dbo.mt_master_pasien_ol.tgl_ctk_kartu, 
                      dbo.mt_master_pasien_ol.jth_kelas, dbo.mt_master_pasien_ol.masa_mulai, dbo.mt_master_pasien_ol.masa_selesai, dbo.mt_master_pasien_ol.flag_member, dbo.mt_master_pasien_ol.jam_lahir, 
                      dbo.mt_master_pasien_ol.berat_badan, dbo.mt_master_pasien_ol.panjang_badan, dbo.mt_master_pasien_ol.warna_kulit, dbo.mt_master_pasien_ol.no_gelang, 
                      dbo.mt_master_pasien_ol.pemberi_no, dbo.mt_master_pasien_ol.mr_ibu, dbo.mt_master_pasien_ol.dok_penolong, dbo.mt_master_pasien_ol.user_id, dbo.mt_master_pasien_ol.penanggung, 
                      dbo.mt_master_pasien_ol.kode_klas, dbo.mt_master_pasien_ol.milik, dbo.mt_master_pasien_ol.status_meninggal, dbo.mt_master_pasien_ol.tgl_input, dbo.mt_master_pasien_ol.jatah_ruang, 
                      dbo.mt_master_pasien_ol.id_dc_kota, dbo.mt_master_pasien_ol.id_dc_kecamatan, dbo.mt_master_pasien_ol.id_dc_kelurahan, dbo.mt_master_pasien_ol.tlp_almt_ttp1, 
                      dbo.mt_master_pasien_ol.field_sem1, dbo.mt_master_pasien_ol.field_sem2, dbo.mt_master_pasien_ol.field_sem3, dbo.mt_master_pasien_ol.field_sem4, dbo.mt_master_pasien_ol.field_sem5, 
                      dbo.mt_master_pasien_ol.field_sem6, dbo.mt_master_pasien_ol.field_sem7, dbo.mt_master_pasien_ol.field_sem8, dbo.mt_master_pasien_ol.field_sem9, dbo.mt_master_pasien_ol.field_sem10, 
                      dbo.mt_nasabah.nama_kelompok AS nasabah, dbo.mt_perusahaan.nama_perusahaan AS perusahaan, dbo.mt_perusahaan.kode_p, dbo.mt_master_pasien_ol.kode_pt, 
                      dbo.mt_master_pasien_ol.nik, dbo.mt_master_pasien_ol.wil_krj, dbo.mt_pt_asuransi.nama_pt, dbo.mt_master_pasien_ol.noKartuPeserta, dbo.mt_master_pasien_ol.no_peserta, 
                      dbo.mt_master_pasien_ol.status_aktif, dbo.mt_master_pasien_ol.id_mt_master_pasien, dbo.mt_master_pasien_ol.no_mr_int, dbo.mt_master_pasien_ol.email, dbo.mt_master_pasien_ol.tgl_reg, 
                      dbo.mt_master_pasien_ol.status_batal, dbo.mt_master_pasien_ol.alasan_batal
FROM         dbo.mt_master_pasien_ol INNER JOIN
                      dbo.mt_nasabah ON dbo.mt_master_pasien_ol.kode_kelompok = dbo.mt_nasabah.kode_kelompok LEFT OUTER JOIN
                      dbo.mt_pt_asuransi ON dbo.mt_master_pasien_ol.kode_pt = dbo.mt_pt_asuransi.kode_pt LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.mt_master_pasien_ol.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_master_pasien_ol_v]");
    }
};
