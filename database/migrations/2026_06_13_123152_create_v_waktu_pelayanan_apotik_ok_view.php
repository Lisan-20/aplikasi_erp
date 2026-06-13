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
        DB::statement("CREATE VIEW dbo.v_waktu_pelayanan_apotik_ok
AS
SELECT     dbo.tc_trans_pelayanan.tgl_transaksi AS tgl_mulai, dbo.v_tgl_siapkan_obat.tgl_input AS tgl_selesai, dbo.v_tgl_siapkan_obat.kode_trans_far, dbo.v_tgl_siapkan_obat.no_resep, 
                      dbo.v_tgl_siapkan_obat.no_mr, dbo.v_tgl_siapkan_obat.nama_pasien, dbo.v_tgl_siapkan_obat.kode_dokter, dbo.v_tgl_siapkan_obat.dokter_pengirim, dbo.v_tgl_siapkan_obat.status_transaksi, 
                      dbo.v_tgl_siapkan_obat.biaya, dbo.v_tgl_siapkan_obat.petugas, dbo.mt_karyawan.no_induk, dbo.mt_karyawan.nama_pegawai, dbo.tc_trans_kasir.tgl_jam AS tgl_kasir, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, DATEDIFF(minute, dbo.v_tgl_siapkan_obat.tgl_input, dbo.v_tgl_siapkan_obat.tgl_serah) AS waktu, dbo.tc_trans_kasir.kode_perusahaan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, DATEDIFF(minute, dbo.v_lap_waktu_pelayanan_apotik.tgl_input, dbo.tc_trans_kasir.tgl_jam) AS lama_input, dbo.v_tgl_siapkan_obat.tgl_serah, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.v_tgl_siapkan_obat.kode_bagian_asal, dbo.v_tgl_siapkan_obat.racik
FROM         dbo.mt_karyawan RIGHT OUTER JOIN
                      dbo.v_lap_waktu_pelayanan_apotik RIGHT OUTER JOIN
                      dbo.v_tgl_siapkan_obat INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.v_tgl_siapkan_obat.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far AND dbo.v_tgl_siapkan_obat.no_mr = dbo.tc_trans_pelayanan.no_mr ON 
                      dbo.v_lap_waktu_pelayanan_apotik.kode_trans_far = dbo.v_tgl_siapkan_obat.kode_trans_far AND dbo.v_lap_waktu_pelayanan_apotik.no_mr = dbo.v_tgl_siapkan_obat.no_mr ON 
                      dbo.mt_karyawan.no_induk = dbo.v_tgl_siapkan_obat.petugas LEFT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.v_tgl_siapkan_obat.tgl_input, dbo.v_tgl_siapkan_obat.kode_trans_far, dbo.v_tgl_siapkan_obat.no_resep, dbo.v_tgl_siapkan_obat.no_mr, dbo.v_tgl_siapkan_obat.nama_pasien, 
                      dbo.v_tgl_siapkan_obat.kode_dokter, dbo.v_tgl_siapkan_obat.dokter_pengirim, dbo.v_tgl_siapkan_obat.status_transaksi, dbo.v_tgl_siapkan_obat.biaya, dbo.v_tgl_siapkan_obat.petugas, 
                      dbo.mt_karyawan.no_induk, dbo.mt_karyawan.nama_pegawai, dbo.tc_trans_kasir.tgl_jam, dbo.tc_trans_kasir.kode_tc_trans_kasir, DATEDIFF(minute, dbo.v_tgl_siapkan_obat.tgl_input, 
                      dbo.v_tgl_siapkan_obat.tgl_serah), dbo.tc_trans_kasir.kode_perusahaan, dbo.tc_trans_pelayanan.kode_kelompok, DATEDIFF(minute, dbo.v_lap_waktu_pelayanan_apotik.tgl_input, 
                      dbo.tc_trans_kasir.tgl_jam), dbo.v_tgl_siapkan_obat.tgl_serah, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.v_tgl_siapkan_obat.kode_bagian_asal, 
                      dbo.v_tgl_siapkan_obat.racik
HAVING      (dbo.v_tgl_siapkan_obat.kode_trans_far NOT IN
                          (SELECT     kode_trans_far
                            FROM          dbo.v_waktu_pelayanan_apotik_racik_ok))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_waktu_pelayanan_apotik_ok]");
    }
};
