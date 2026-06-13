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
        DB::statement("CREATE OR ALTER VIEW dbo.obat_1sehat_v
AS
SELECT     TOP (100) PERCENT dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far_detail.jumlah_pesan, dbo.fr_tc_far_detail.jumlah_tebus, 
                      dbo.mt_barang.satuan_kekuatan, dbo.mt_barang.kekuatan, dbo.mt_barang.kfa_poa, dbo.mt_generik.kfa_code, dbo.fr_tc_far_detail.jumlah_retur, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.tgl_trans, 
                      dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.dokter_pengirim, dbo.mt_generik.nama_generik, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, 
                      dbo.fr_tc_far_detail.kd_tr_resep, dbo.fr_tc_far_detail.takaran, dbo.fr_tc_far_detail.penggunaan, dbo.fr_tc_far_detail.instruksi, dbo.fr_tc_far_detail.jml_pakai, dbo.fr_tc_far_detail.jml_takar
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_generik ON dbo.mt_barang.kode_generik = dbo.mt_generik.kode_generik
WHERE     (dbo.mt_generik.kfa_code IS NOT NULL) AND (dbo.mt_generik.kfa_code <> '') AND (dbo.fr_tc_far.kode_profit = 2000) AND (dbo.fr_tc_far.dokter_pengirim = 'dr. Cecep Suryani Sobur Sp.PD') AND 
                      (dbo.fr_tc_far_detail.jumlah_retur IS NULL) AND (dbo.mt_barang.satuan_kekuatan IS NOT NULL) AND (dbo.mt_barang.satuan_kekuatan <> '') AND (dbo.mt_barang.kekuatan IS NOT NULL) AND 
                      (dbo.mt_barang.kekuatan <> '') AND (dbo.mt_barang.kfa_poa IS NOT NULL) AND (dbo.mt_barang.kfa_poa <> '')
ORDER BY dbo.fr_tc_far.tgl_trans DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [obat_1sehat_v]");
    }
};
