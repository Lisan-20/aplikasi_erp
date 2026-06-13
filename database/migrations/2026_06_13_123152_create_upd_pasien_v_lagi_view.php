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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_pasien_v_lagi
AS
SELECT     dbo.mt_master_pasien.id_mt_master_pasien, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.hubungan, dbo.mt_master_pasien.no_urutan, dbo.mt_master_pasien.kode_login, 
                      dbo.mt_master_pasien.kota, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.nama_panggilan, dbo.mt_master_pasien.nama_kel_pasien, dbo.mt_master_pasien.no_ktp, 
                      dbo.mt_master_pasien.pekerjaan, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tempat_lahir, dbo.mt_master_pasien.umur_pasien, dbo.mt_master_pasien.almt_ttp_pasien, 
                      dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.status_perkaw, dbo.mt_master_pasien.suku, dbo.mt_master_pasien.kode_agama, 
                      dbo.mt_master_pasien.kebangsaan, dbo.mt_master_pasien.alamat_lokal, dbo.mt_master_pasien.tlp_almt_lkl, dbo.mt_master_pasien.nama_kel_ter, dbo.mt_master_pasien.nama_almt_kel, 
                      dbo.mt_master_pasien.hubungan_kel, dbo.mt_master_pasien.tlp_kel, dbo.mt_master_pasien.kode_pendidikan, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, 
                      dbo.mt_master_pasien.kd_bgn, dbo.mt_master_pasien.prosedur_rs, dbo.mt_master_pasien.nama_almt_kantor, dbo.mt_master_pasien.jabatan, dbo.mt_master_pasien.gol_darah, 
                      dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.nama_ayah, dbo.mt_master_pasien.umur_ayah, dbo.mt_master_pasien.pekerjaan_ayah, dbo.mt_master_pasien.nama_ibu, 
                      dbo.mt_master_pasien.umur_ibu, dbo.mt_master_pasien.pekerjaan_ibu, dbo.mt_master_pasien.no_askes, dbo.mt_master_pasien.nm_inst_askes, dbo.mt_master_pasien.tgl_ctk_kartu, 
                      dbo.mt_master_pasien.jth_kelas, dbo.mt_master_pasien.masa_mulai, dbo.mt_master_pasien.masa_selesai, dbo.mt_master_pasien.flag_member, dbo.mt_master_pasien.jam_lahir, 
                      dbo.mt_master_pasien.berat_badan, dbo.mt_master_pasien.panjang_badan, dbo.mt_master_pasien.warna_kulit, dbo.mt_master_pasien.no_gelang, dbo.mt_master_pasien.pemberi_no, 
                      dbo.mt_master_pasien.mr_ibu, dbo.mt_master_pasien.dok_penolong, dbo.mt_master_pasien.user_id, dbo.mt_master_pasien.penanggung, dbo.mt_master_pasien.kode_klas, 
                      dbo.mt_master_pasien.milik, dbo.mt_master_pasien.status_meninggal, dbo.mt_master_pasien.tgl_input, dbo.mt_master_pasien.jatah_ruang, dbo.mt_master_pasien.id_dc_kota, 
                      dbo.mt_master_pasien.id_dc_kecamatan, dbo.mt_master_pasien.id_dc_kelurahan, dbo.mt_master_pasien.tlp_almt_ttp1, dbo.mt_master_pasien.field_sem1, dbo.mt_master_pasien.field_sem2, 
                      dbo.mt_master_pasien.field_sem3, dbo.mt_master_pasien.field_sem4, dbo.mt_master_pasien.field_sem5, dbo.mt_master_pasien.field_sem6, dbo.mt_master_pasien.field_sem7, 
                      dbo.mt_master_pasien.field_sem8, dbo.mt_master_pasien.field_sem9, dbo.mt_master_pasien.field_sem10, dbo.mt_master_pasien.kode_pt, dbo.mt_master_pasien.nik, 
                      dbo.mt_master_pasien.wil_krj, dbo.mt_master_pasien.flag_pas_lm, dbo.mt_master_pasien.flag_daftar, dbo.mt_master_pasien.nama_karyawan, dbo.mt_master_pasien.bagian_kerja, 
                      dbo.mt_master_pasien.no_peserta, dbo.mt_master_pasien.no_polis, dbo.mt_master_pasien.noKartuPeserta, dbo.mt_master_pasien.nikPeserta, dbo.mt_master_pasien.namaPeserta, 
                      dbo.mt_master_pasien.pisaPeserta, dbo.mt_master_pasien.sexPeserta, dbo.mt_master_pasien.tglLahirPeserta, dbo.mt_master_pasien.jenisPeserta, dbo.mt_master_pasien.flag_kelamin, 
                      dbo.pasien_rsbh.kode_perusahaan AS kode_perusahaan_rs, dbo.pasien_rsbh.kode_perusahaanpj, dbo.pasien_rsbh.kode_cus, dbo.master_perusahaan_rsbh.nama_perusahaan, 
                      dbo.mt_perusahaan.kode_perusahaan AS kode_per, dbo.pasien_rsbh.aktif, dbo.mt_master_pasien.status_aktif
FROM         dbo.mt_master_pasien INNER JOIN
                      dbo.pasien_rsbh ON dbo.mt_master_pasien.no_mr = dbo.pasien_rsbh.no_mr INNER JOIN
                      dbo.master_perusahaan_rsbh ON dbo.pasien_rsbh.kode_perusahaanpj = dbo.master_perusahaan_rsbh.kode_perusahaan INNER JOIN
                      dbo.mt_perusahaan ON dbo.master_perusahaan_rsbh.nama_perusahaan = dbo.mt_perusahaan.nama_perusahaan
WHERE     (dbo.pasien_rsbh.kode_perusahaan > N'0') AND (dbo.pasien_rsbh.aktif <> 'Y')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_pasien_v_lagi]");
    }
};
