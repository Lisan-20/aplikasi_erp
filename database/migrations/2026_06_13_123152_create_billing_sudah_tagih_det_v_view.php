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
        DB::statement("CREATE VIEW dbo.billing_sudah_tagih_det_v
AS
SELECT     TOP (100) PERCENT dbo.tc_tagih.jenis_tagih, MONTH(dbo.tc_tagih_det.tgl_kui) AS bln, dbo.tc_tagih.tahun AS thn, dbo.tc_tagih.status_batal, 
                      SUM(dbo.tc_bayar_tagih.diskon) AS diskon, dbo.tc_tagih.id_tertagih, dbo.mt_perusahaan.flag_jpk, dbo.mt_perusahaan.flag_kapitasi, 
                      SUM(dbo.tc_tagih_det.jumlah_tagih) AS jumlah_tagih, dbo.tc_tagih_det.no_mr, dbo.tc_tagih_det.no_registrasi, dbo.tc_tagih_det.nama_pasien, 
                      dbo.tc_tagih_det.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.pembayar,
                       dbo.tc_trans_kasir.kd_inv_persh_tx, dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_tagih_det INNER JOIN
                      dbo.tc_tagih ON dbo.tc_tagih_det.id_tc_tagih = dbo.tc_tagih.id_tc_tagih INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_tagih_det.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_tagih.id_tertagih = dbo.mt_perusahaan.kode_perusahaan LEFT OUTER JOIN
                      dbo.tc_bayar_tagih ON dbo.tc_tagih.id_tc_tagih = dbo.tc_bayar_tagih.id_tc_tagih
GROUP BY dbo.tc_tagih.jenis_tagih, MONTH(dbo.tc_tagih_det.tgl_kui), dbo.tc_tagih.tahun, dbo.tc_tagih.status_batal, dbo.tc_tagih.id_tertagih, dbo.mt_perusahaan.flag_jpk, 
                      dbo.mt_perusahaan.flag_kapitasi, dbo.tc_tagih_det.no_mr, dbo.tc_tagih_det.no_registrasi, dbo.tc_tagih_det.nama_pasien, dbo.tc_tagih_det.kode_tc_trans_kasir, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.kode_bagian, dbo.tc_trans_kasir.pembayar, dbo.tc_trans_kasir.kd_inv_persh_tx, 
                      dbo.tc_trans_kasir.flag_tagih, dbo.tc_trans_kasir.tgl_jam
HAVING      (dbo.tc_tagih.status_batal IS NULL)
ORDER BY bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_sudah_tagih_det_v]");
    }
};
