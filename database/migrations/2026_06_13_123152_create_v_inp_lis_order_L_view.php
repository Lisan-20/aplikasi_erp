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
        DB::statement("CREATE OR ALTER VIEW dbo.v_inp_lis_order_L
AS
SELECT     dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_kunjungan.status_cito, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_kunjungan.kode_dokter, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, dbo.pm_tc_penunjang.dr_pengirim AS dokter, 
                      dbo.pm_tc_penunjang.tgl_daftar, dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_mt_standarhasil.kode_tindakan, 
                      dbo.mt_pasien_penunjang.tgl_lahir AS tgl_lhr, dbo.mt_pasien_penunjang.tempat_lahir, dbo.mt_pasien_penunjang.alamat_pasien AS alamat, 
                      dbo.mt_pasien_penunjang.jen_kelamin, dbo.mt_pasien_penunjang.kode_kelompok, dbo.mt_pasien_penunjang.kode_perusahaan, 
                      dbo.mt_pasien_penunjang.dokter_pengirim AS dr_pengirim, dbo.mt_pasien_penunjang.nama_pasien
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_trans_pelayanan.kode_penunjang = dbo.pm_tc_penunjang.kode_penunjang INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.tc_trans_pelayanan.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif INNER JOIN
                      dbo.mt_pasien_penunjang ON dbo.pm_tc_penunjang.kode_penunjang = dbo.mt_pasien_penunjang.kode_penunjang
GROUP BY dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi,
                       dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_kunjungan.status_cito, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_kunjungan.kode_dokter, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, dbo.pm_tc_penunjang.dr_pengirim, dbo.pm_tc_penunjang.tgl_daftar, 
                      dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_mt_standarhasil.kode_tindakan, dbo.mt_pasien_penunjang.tgl_lahir, 
                      dbo.mt_pasien_penunjang.tempat_lahir, dbo.mt_pasien_penunjang.alamat_pasien, dbo.mt_pasien_penunjang.jen_kelamin, 
                      dbo.mt_pasien_penunjang.kode_kelompok, dbo.mt_pasien_penunjang.kode_perusahaan, dbo.mt_pasien_penunjang.dokter_pengirim, 
                      dbo.mt_pasien_penunjang.nama_pasien
HAVING      (dbo.tc_trans_pelayanan.no_mr LIKE '%L')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_inp_lis_order_L]");
    }
};
