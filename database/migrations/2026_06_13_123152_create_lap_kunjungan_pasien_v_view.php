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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_pasien_v
AS
SELECT     dbo.tc_registrasi.id_tc_registrasi, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur, dbo.tc_registrasi.tgl_input, 
                      dbo.tc_registrasi.id_paket, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.nik, dbo.tc_registrasi.kode_pt, dbo.tc_registrasi.nama_pt, dbo.tc_registrasi.status_man, dbo.tc_registrasi.no_jkn, 
                      dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.kode_plafon, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.tgl_keluar, dbo.mt_perusahaan.flag_kapitasi, dbo.mt_bagian.validasi, dbo.mt_bagian.validasi_lap_rm, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.tc_kunjungan.flag_titipan, dbo.mt_bagian.validasi AS val
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL)
GROUP BY dbo.tc_registrasi.id_tc_registrasi, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur, dbo.tc_registrasi.tgl_input, 
                      dbo.tc_registrasi.id_paket, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.nik, dbo.tc_registrasi.kode_pt, dbo.tc_registrasi.nama_pt, dbo.tc_registrasi.status_man, dbo.tc_registrasi.no_jkn, 
                      dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.kode_plafon, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.tgl_keluar, dbo.mt_perusahaan.flag_kapitasi, dbo.mt_bagian.validasi, dbo.mt_bagian.validasi_lap_rm, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.tc_kunjungan.flag_titipan
HAVING      (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pasien_v]");
    }
};
