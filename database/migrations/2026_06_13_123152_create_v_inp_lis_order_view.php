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
        DB::statement("CREATE VIEW dbo.v_inp_lis_order
AS
SELECT dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_master_pasien.nama_pasien, dbo.tc_trans_pelayanan.kode_bagian, 
             dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.mt_master_pasien.jen_kelamin, dbo.tc_kunjungan.status_cito, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
             dbo.tc_kunjungan.kode_dokter, dbo.mt_master_pasien.almt_ttp_pasien AS alamat, dbo.mt_master_pasien.tgl_lhr, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, dbo.pm_tc_penunjang.dr_pengirim, 
             dbo.pm_tc_penunjang.tgl_daftar, dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.pm_mt_standarhasil.catatan, 
             dbo.pm_tc_penunjang.status_daftar, dbo.pm_tc_penunjang.waktu_sampel
FROM   dbo.tc_trans_pelayanan INNER JOIN
             dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
             dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
             dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
             dbo.pm_tc_penunjang ON dbo.tc_trans_pelayanan.kode_penunjang = dbo.pm_tc_penunjang.kode_penunjang LEFT OUTER JOIN
             dbo.pm_mt_standarhasil ON dbo.tc_trans_pelayanan.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif
GROUP BY dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_dokter1, dbo.mt_master_pasien.nama_pasien, dbo.tc_trans_pelayanan.kode_bagian, 
             dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.mt_master_pasien.jen_kelamin, dbo.tc_kunjungan.status_cito, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_tarif, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
             dbo.tc_kunjungan.kode_dokter, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_dokter3, dbo.pm_tc_penunjang.dr_pengirim, 
             dbo.pm_tc_penunjang.tgl_daftar, dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_mt_standarhasil.kode_mt_hasilpm, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.pm_mt_standarhasil.catatan, 
             dbo.pm_tc_penunjang.status_daftar, dbo.pm_tc_penunjang.waktu_sampel
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_inp_lis_order]");
    }
};
