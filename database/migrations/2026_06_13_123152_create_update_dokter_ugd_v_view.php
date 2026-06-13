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
        DB::statement("CREATE OR ALTER VIEW dbo.update_dokter_ugd_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.no_registrasi, DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS tahun, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.jenis_tindakan, 
                      dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.gd_tc_gawat_darurat.dokter_jaga
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.gd_tc_gawat_darurat ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.gd_tc_gawat_darurat.no_kunjungan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 7) AND (dbo.tc_trans_pelayanan.kode_dokter1 = '') AND 
                      (dbo.tc_trans_pelayanan.bill_dr1 > 0) OR
                      (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 7) AND (dbo.tc_trans_pelayanan.kode_dokter1 = '') AND 
                      (dbo.tc_trans_pelayanan.bill_dr1_jatah > 0)
ORDER BY dbo.tc_trans_pelayanan.tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_dokter_ugd_v]");
    }
};
