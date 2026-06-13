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
        DB::statement("CREATE VIEW dbo.lap_pemeriksaan_pm_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_kunjungan, DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.no_mr, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.stat_pasien, dbo.tc_trans_pelayanan.kode_tarif, dbo.mt_master_tarif.nama_tarif, 
                      dbo.tc_trans_pelayanan.jumlah
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_kunjungan.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_tarif ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_bagian LIKE '05%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_pemeriksaan_pm_v]");
    }
};
