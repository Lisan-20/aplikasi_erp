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
        DB::statement("CREATE VIEW dbo.fr_his_susu_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.alamat_pasien, 
                      dbo.fr_tc_far.telpon_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far_detail.kd_tr_resep, dbo.fr_tc_far_detail.jumlah_pesan, 
                      dbo.fr_tc_far_detail.jumlah_tebus, dbo.fr_tc_far_detail.sisa, dbo.fr_tc_far_detail.harga_beli, dbo.fr_tc_far_detail.harga_jual, 
                      dbo.fr_tc_far_detail.harga_r, dbo.fr_tc_far_detail.status_kirim, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.no_resep, 
                      dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.no_mr, dbo.fr_tc_far_detail.jumlah_retur, dbo.fr_tc_far_detail.harga_r_retur, dbo.fr_tc_far.kode_bagian, 
                      dbo.fr_tc_far.petugas, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far_detail.diskon, dbo.fr_tc_far_detail.kode_brg, 
                      dbo.mt_barang.nama_brg
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.fr_tc_far.status_transaksi = 1) AND (dbo.mt_barang.nama_brg LIKE '%susu%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_his_susu_v]");
    }
};
