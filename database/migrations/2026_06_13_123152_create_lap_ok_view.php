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
        DB::statement("CREATE VIEW dbo.lap_ok
AS
SELECT     TOP (100) PERCENT dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.status_batal, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.bill_rs, 
                      dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr1_jatah, dbo.tc_trans_pelayanan.bill_dr2_jatah, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_kunjungan.tgl_masuk, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.tc_kunjungan.tgl_keluar, YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, 
                      DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
WHERE     (dbo.tc_kunjungan.kode_bagian_tujuan = '030901')
ORDER BY thn, bln, tgl, dbo.tc_kunjungan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_ok]");
    }
};
