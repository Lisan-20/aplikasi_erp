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
        DB::statement("CREATE OR ALTER VIEW dbo.pemberian_obat_RI_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.no_resep, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far_detail.kode_brg, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.fr_tc_far.kode_profit, 
                      dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far_detail.tot_pakai_ri, dbo.fr_tc_far_detail.sisa_pakai_ri, dbo.fr_tc_far_detail.kd_tr_resep, 
                      dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far_detail.instruksi, dbo.fr_tc_far_detail.jml_pakai, dbo.fr_tc_far_detail.jml_takar, dbo.mt_penggunaan.penggunaan, 
                      dbo.mt_takaran.takaran, dbo.fr_tc_far_detail.jumlah_pesan, CASE WHEN jumlah_pakai IS NULL THEN 0 ELSE jumlah_pakai END AS jumlah_pakai, dbo.fr_tc_far_detail.waktu_pakai, 
                      dbo.fr_tc_far_detail.jam1, dbo.fr_tc_far_detail.jam2, dbo.fr_tc_far_detail.jam3, dbo.fr_tc_far_detail.jam4, dbo.fr_tc_far_detail.jam5, dbo.fr_tc_far_detail.tgl_update1, dbo.fr_tc_far_detail.tgl_update2, 
                      dbo.fr_tc_far_detail.tgl_update3, dbo.fr_tc_far_detail.tgl_update4, dbo.fr_tc_far_detail.tgl_update5, dbo.fr_tc_far_detail.id_user1, dbo.fr_tc_far_detail.id_user2, dbo.fr_tc_far_detail.id_user3, 
                      dbo.fr_tc_far_detail.id_user4, dbo.fr_tc_far_detail.id_user5
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.penggunaan_obat_ri_det_v ON dbo.fr_tc_far_detail.kd_tr_resep = dbo.penggunaan_obat_ri_det_v.kd_tr_resep LEFT OUTER JOIN
                      dbo.mt_takaran ON dbo.fr_tc_far_detail.takaran = dbo.mt_takaran.id_takaran LEFT OUTER JOIN
                      dbo.mt_penggunaan ON dbo.fr_tc_far_detail.penggunaan = dbo.mt_penggunaan.id
WHERE     (dbo.fr_tc_far.status_transaksi = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pemberian_obat_RI_v]");
    }
};
