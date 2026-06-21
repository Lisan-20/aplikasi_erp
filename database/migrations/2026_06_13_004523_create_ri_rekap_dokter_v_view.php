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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_rekap_dokter_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, 
                      DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_master_pasien.jen_kelamin, 
                      COUNT(dbo.mt_master_pasien.jen_kelamin) AS jml_jen_kelamin, COUNT(dbo.tc_registrasi.kode_kelompok) AS jml_kode_kelompok, dbo.tc_registrasi.stat_pasien, 
                      COUNT(dbo.tc_registrasi.stat_pasien) AS jml_stat_pasien, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
GROUP BY DAY(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_master_pasien.jen_kelamin, dbo.tc_registrasi.stat_pasien, 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_kunjungan.no_kunjungan, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan
HAVING      (YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) IS NOT NULL) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) IS NOT NULL) AND 
                      (DAY(dbo.tc_trans_pelayanan.tgl_transaksi) IS NOT NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '03%') AND 
                      (dbo.tc_trans_pelayanan.kode_dokter1 IS NOT NULL)
ORDER BY thn, bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_rekap_dokter_v]");
    }
};
