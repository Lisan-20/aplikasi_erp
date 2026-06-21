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
        DB::statement("CREATE OR ALTER VIEW dbo.pengajuan_kredesialing_v
AS
SELECT     dbo.tc_kredensialing.npp, dbo.mt_karyawan.nama_pegawai, dbo.mt_keperawatan.nm_keperawatan, dbo.tc_kredensialing.id_pk, dbo.tc_kredensialing.id_kep, dbo.mt_perawat_klinik.nama_pk, 
                      dbo.tc_kredensialing.id_kred, dbo.tc_kredensialing.tgl_isi_mandiri, dbo.tc_kredensialing.id_user_mandiri, dbo.tc_kredensialing.tgl_isi_tim, dbo.tc_kredensialing.id_user_tim, 
                      dbo.tc_kredensialing.tgl_rekomendasi, dbo.tc_kredensialing.id_user_rekomendasi, dbo.tc_kredensialing.sartifikasi, dbo.tc_kredensialing.ringkasan, dbo.tc_kredensialing.rekomendasi, 
                      dbo.tc_kredensialing.catatan, dbo.tc_kredensialing.nama_file, dbo.tc_kredensialing.no_sk, dbo.tc_kredensialing.tgl_sk, dbo.tc_kredensialing.id_pengajuan, dbo.tc_kredensialing.soal_1, 
                      dbo.tc_kredensialing.soal_1_text, dbo.tc_kredensialing.soal_2, dbo.tc_kredensialing.soal_2_text1, dbo.tc_kredensialing.soal_2_text2, dbo.tc_kredensialing.soal_3, dbo.tc_kredensialing.input_tgl, 
                      dbo.tc_kredensialing.flag_ver_ka_unit, dbo.tc_kredensialing.tgl_ver_ka_unit, dbo.tc_kredensialing.alasan_tolak, dbo.tc_kredensialing.tgl_tolak, dbo.tc_kredensialing.user_tolak, 
                      dbo.tc_kredensialing.status, dbo.tc_kredensialing.input_id, dbo.tc_kredensialing.status_tgl, dbo.tc_kredensialing.id_riwayat_pendidikan, dbo.tc_kredensialing.kode_bagian, 
                      dbo.tc_kredensialing.kode_jabatan, dbo.tc_kredensialing.STR_id_tc_surat_izin, dbo.tc_kredensialing.SIPP_id_tc_surat_izin, dbo.tc_kredensialing.id_user_ver_ka_unit, 
                      dbo.tc_kredensialing.st_akhir, dbo.tc_kredensialing.id_kred_awal, dbo.tc_kredensialing.st_akhir_tgl, dbo.tc_kredensialing.st_akhir_user, dbo.tc_kredensialing.no_skpk, 
                      dbo.tc_kredensialing.tgl_skpk, dbo.tc_kredensialing.id_dir_skpk, dbo.tc_kredensialing.id_luar, dbo.dc_wilayah_kerja.nawil_kerja, dbo.tc_kredensialing.ko_wil, dbo.tc_kredensialing.npp_tim, 
                      dbo.tc_kredensialing.tgl_jadwal_tim, dbo.tc_kredensialing.note_tim, dbo.tc_kredensialing.no_urut_rekom, dbo.tc_kredensialing.no_surat_rekom, dbo.tc_kredensialing.alasan
FROM         dbo.tc_kredensialing INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_kredensialing.npp = dbo.mt_karyawan.npp INNER JOIN
                      dbo.mt_keperawatan ON dbo.tc_kredensialing.id_kep = dbo.mt_keperawatan.id_kep INNER JOIN
                      dbo.mt_perawat_klinik ON dbo.tc_kredensialing.id_pk = dbo.mt_perawat_klinik.id_pk INNER JOIN
                      dbo.dc_wilayah_kerja ON dbo.tc_kredensialing.ko_wil = dbo.dc_wilayah_kerja.ko_wil
GROUP BY dbo.tc_kredensialing.npp, dbo.mt_karyawan.nama_pegawai, dbo.mt_keperawatan.nm_keperawatan, dbo.tc_kredensialing.id_pk, dbo.tc_kredensialing.id_kep, dbo.mt_perawat_klinik.nama_pk, 
                      dbo.tc_kredensialing.id_kred, dbo.tc_kredensialing.tgl_isi_mandiri, dbo.tc_kredensialing.id_user_mandiri, dbo.tc_kredensialing.tgl_isi_tim, dbo.tc_kredensialing.id_user_tim, 
                      dbo.tc_kredensialing.tgl_rekomendasi, dbo.tc_kredensialing.id_user_rekomendasi, dbo.tc_kredensialing.sartifikasi, dbo.tc_kredensialing.ringkasan, dbo.tc_kredensialing.rekomendasi, 
                      dbo.tc_kredensialing.catatan, dbo.tc_kredensialing.nama_file, dbo.tc_kredensialing.no_sk, dbo.tc_kredensialing.tgl_sk, dbo.tc_kredensialing.id_pengajuan, dbo.tc_kredensialing.soal_1, 
                      dbo.tc_kredensialing.soal_1_text, dbo.tc_kredensialing.soal_2, dbo.tc_kredensialing.soal_2_text1, dbo.tc_kredensialing.soal_2_text2, dbo.tc_kredensialing.soal_3, dbo.tc_kredensialing.input_tgl, 
                      dbo.tc_kredensialing.flag_ver_ka_unit, dbo.tc_kredensialing.tgl_ver_ka_unit, dbo.tc_kredensialing.alasan_tolak, dbo.tc_kredensialing.tgl_tolak, dbo.tc_kredensialing.user_tolak, 
                      dbo.tc_kredensialing.status, dbo.tc_kredensialing.input_id, dbo.tc_kredensialing.status_tgl, dbo.tc_kredensialing.id_riwayat_pendidikan, dbo.tc_kredensialing.kode_bagian, 
                      dbo.tc_kredensialing.kode_jabatan, dbo.tc_kredensialing.STR_id_tc_surat_izin, dbo.tc_kredensialing.SIPP_id_tc_surat_izin, dbo.tc_kredensialing.id_user_ver_ka_unit, 
                      dbo.tc_kredensialing.st_akhir, dbo.tc_kredensialing.id_kred_awal, dbo.tc_kredensialing.st_akhir_tgl, dbo.tc_kredensialing.st_akhir_user, dbo.tc_kredensialing.no_skpk, 
                      dbo.tc_kredensialing.tgl_skpk, dbo.tc_kredensialing.id_dir_skpk, dbo.tc_kredensialing.id_luar, dbo.dc_wilayah_kerja.nawil_kerja, dbo.tc_kredensialing.ko_wil, dbo.tc_kredensialing.npp_tim, 
                      dbo.tc_kredensialing.tgl_jadwal_tim, dbo.tc_kredensialing.note_tim, dbo.tc_kredensialing.no_urut_rekom, dbo.tc_kredensialing.no_surat_rekom, dbo.tc_kredensialing.alasan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengajuan_kredesialing_v]");
    }
};
