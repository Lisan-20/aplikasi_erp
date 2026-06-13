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
        DB::statement("CREATE VIEW dbo.tc_laporan_rawat_jalan_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.tc_registrasi.stat_pasien, dbo.tc_trans_pelayanan.status_selesai, SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs_tot, dbo.tc_trans_pelayanan.kode_dokter1, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1_tot, dbo.tc_trans_pelayanan.kode_dokter2, SUM(dbo.tc_trans_pelayanan.bill_dr2) AS bill_dr2_tot, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.tgl_keluar, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan LEFT OUTER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_dokter1, MONTH(dbo.tc_kunjungan.tgl_keluar), 
                      DAY(dbo.tc_kunjungan.tgl_keluar), dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.kode_kelompok, 
                      dbo.tc_registrasi.stat_pasien, YEAR(dbo.tc_kunjungan.tgl_keluar), dbo.tc_trans_pelayanan.kode_dokter2, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_selesai, dbo.mt_master_pasien.tgl_lhr, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.status_batal, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi
HAVING      (dbo.tc_trans_pelayanan.status_selesai > 0) AND (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi IN ('RJ', 'AJ', 'NK'))
ORDER BY thn, bln, tgl, dbo.tc_trans_pelayanan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_laporan_rawat_jalan_v]");
    }
};
