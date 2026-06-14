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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pasien_ranap_v
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, 
                      dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur, dbo.tc_registrasi.tgl_input, dbo.tc_registrasi.id_paket, dbo.tc_registrasi.no_jaminan, 
                      dbo.tc_registrasi.nik, dbo.tc_registrasi.kode_pt, dbo.tc_registrasi.nama_pt, dbo.tc_registrasi.status_man, dbo.tc_registrasi.no_jkn, 
                      dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.kode_plafon, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.no_kunjungan, 
                      dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_keluar, dbo.bagian_asal_v.kode_bagian AS bagian_asal, 
                      dbo.hari_rawat_v.jumlah AS hari_rawat, dbo.tc_registrasi.no_registrasi
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.bagian_asal_v ON dbo.tc_registrasi.no_registrasi = dbo.bagian_asal_v.no_registrasi AND 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.bagian_asal_v.kode_tc_trans_kasir INNER JOIN
                      dbo.hari_rawat_v ON dbo.tc_registrasi.no_registrasi = dbo.hari_rawat_v.no_registrasi
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL)
GROUP BY dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, 
                      dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, 
                      dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur, dbo.tc_registrasi.tgl_input, dbo.tc_registrasi.id_paket, dbo.tc_registrasi.no_jaminan, 
                      dbo.tc_registrasi.nik, dbo.tc_registrasi.kode_pt, dbo.tc_registrasi.nama_pt, dbo.tc_registrasi.status_man, dbo.tc_registrasi.no_jkn, 
                      dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.kode_plafon, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.no_kunjungan, 
                      dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_keluar, dbo.bagian_asal_v.kode_bagian, dbo.hari_rawat_v.jumlah, 
                      dbo.tc_registrasi.no_registrasi
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.kode_bagian_keluar LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pasien_ranap_v]");
    }
};
