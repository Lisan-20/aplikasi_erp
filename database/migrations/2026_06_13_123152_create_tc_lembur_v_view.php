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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_lembur_v
AS
SELECT     a.id_hrtc_lembur, a.npp, a.tgl_lembur, a.kegiatan, a.jam_mulai_lembur, a.jam_akhir_lembur, a.jumlah_jam_lembur, a.jumlah_uang_makan, a.jumlah_uang_lembur, a.surat_perintah, a.input_id, 
                      a.input_tgl, a.status, a.status_tgl, a.keterangan, b.nama_pegawai, a.flag_gol_lembur, dbo.mt_jabatan.nama_jabatan, dbo.mt_jabatan.kd_st, dbo.mt_jabatan.ref_jab, dbo.mt_jabatan.lev_jab, 
                      dbo.mt_jabatan.kode_kel_kerja, a.flag_ver, a.tgl_ver, a.user_ver, a.flag, a.no_urut_periodik, a.flag_ver_ka_unit, a.tgl_ver_ka_unit, a.user_ver_ka_unit, a.ket_ka_unit, a.flag_ver_ka_bid, 
                      a.tgl_ver_ka_bid, a.user_ver_ka_bid, a.ket_ka_bid, a.flag_ver_wadir, a.tgl_ver_wadir, a.user_ver_wadir, a.ket_wadir, a.tgl_tolak, a.alasan_tolak, a.user_tolak, b.kode_bagian
FROM         dbo.tc_lembur AS a INNER JOIN
                      dbo.mt_karyawan AS b ON a.npp = b.npp LEFT OUTER JOIN
                      dbo.mt_jabatan ON b.kode_jabatan = dbo.mt_jabatan.kode_jabatan
GROUP BY a.id_hrtc_lembur, a.npp, a.tgl_lembur, a.kegiatan, a.jam_mulai_lembur, a.jam_akhir_lembur, a.jumlah_jam_lembur, a.jumlah_uang_makan, a.jumlah_uang_lembur, a.surat_perintah, a.input_id, 
                      a.input_tgl, a.status, a.status_tgl, a.keterangan, b.nama_pegawai, a.flag_gol_lembur, dbo.mt_jabatan.nama_jabatan, dbo.mt_jabatan.kd_st, dbo.mt_jabatan.ref_jab, dbo.mt_jabatan.lev_jab, 
                      dbo.mt_jabatan.kode_kel_kerja, a.flag_ver, a.tgl_ver, a.user_ver, a.flag, a.no_urut_periodik, a.flag_ver_ka_unit, a.tgl_ver_ka_unit, a.user_ver_ka_unit, a.ket_ka_unit, a.flag_ver_ka_bid, 
                      a.tgl_ver_ka_bid, a.user_ver_ka_bid, a.ket_ka_bid, a.flag_ver_wadir, a.tgl_ver_wadir, a.user_ver_wadir, a.ket_wadir, a.tgl_tolak, a.alasan_tolak, a.user_tolak, b.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lembur_v]");
    }
};
