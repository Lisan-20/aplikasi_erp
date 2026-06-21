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
        DB::statement("CREATE OR ALTER VIEW dbo.batal_fr_tc_far_detail_v
AS
SELECT     dbo.fr_tc_far_detail.kd_tr_resep, dbo.fr_tc_far_detail.kode_trans_far, dbo.fr_tc_far_detail.jumlah_pesan, dbo.fr_tc_far_detail.jumlah_tebus, dbo.fr_tc_far_detail.sisa, 
                      dbo.fr_tc_far_detail.jumlah_retur, dbo.fr_tc_far_detail.harga_r_retur, dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far_detail.harga_beli, dbo.fr_tc_far_detail.harga_jual, dbo.fr_tc_far_detail.harga_r, 
                      dbo.fr_tc_far_detail.biaya_tebus, dbo.fr_tc_far_detail.bill_rs, dbo.fr_tc_far_detail.bill_dr1, dbo.fr_tc_far_detail.bill_dr2, dbo.fr_tc_far_detail.bill_rs_askes, dbo.fr_tc_far_detail.bill_dr1_askes, 
                      dbo.fr_tc_far_detail.bill_dr2_askes, dbo.fr_tc_far_detail.bill_rs_jatah, dbo.fr_tc_far_detail.bill_dr1_jatah, dbo.fr_tc_far_detail.bill_dr2_jatah, dbo.fr_tc_far_detail.status_kirim, 
                      dbo.fr_tc_far_detail.status_retur, dbo.fr_tc_far_detail.kode_cito, dbo.fr_tc_far_detail.racik, dbo.fr_tc_far_detail.obat_cover_persh, dbo.fr_tc_far_detail.diskon, dbo.fr_tc_far_detail.kode_diskon, 
                      dbo.fr_tc_far_detail.takaran, dbo.fr_tc_far_detail.penggunaan, dbo.fr_tc_far_detail.instruksi, dbo.fr_tc_far_detail.jml_pakai, dbo.fr_tc_far_detail.jml_takar, dbo.fr_tc_far_detail.jml_konversi, 
                      dbo.fr_tc_far_detail.tgl_input, dbo.fr_tc_far_detail.alasan_retur, dbo.fr_tc_far_detail.profit_2_persen, dbo.fr_tc_far_detail.komp_dtd, dbo.fr_tc_far_detail.racikan_dr, dbo.fr_tc_far_detail.tot_pakai_ri, 
                      dbo.fr_tc_far_detail.sisa_pakai_ri, dbo.fr_tc_far_detail.waktu_pakai, dbo.fr_tc_far_detail.bud, dbo.fr_tc_far_detail.jam1, dbo.fr_tc_far_detail.jam2, dbo.fr_tc_far_detail.jam3, dbo.fr_tc_far_detail.jam4, 
                      dbo.fr_tc_far_detail.jam5, dbo.fr_tc_far_detail.tgl_update1, dbo.fr_tc_far_detail.tgl_update2, dbo.fr_tc_far_detail.tgl_update3, dbo.fr_tc_far_detail.tgl_update4, dbo.fr_tc_far_detail.tgl_update5, 
                      dbo.fr_tc_far_detail.id_user1, dbo.fr_tc_far_detail.id_user2, dbo.fr_tc_far_detail.id_user3, dbo.fr_tc_far_detail.id_user4, dbo.fr_tc_far_detail.id_user5, dbo.fr_tc_far_detail.id_resep_ri_dr, 
                      dbo.fr_tc_far_detail.isi_cara, dbo.fr_tc_far_detail.isi_waktu, dbo.fr_tc_far_detail.isi_signa, dbo.fr_tc_far_detail.tgl_update_rek, dbo.fr_tc_far_detail.id_user_rek, dbo.fr_tc_far_detail.ttd_pasien1, 
                      dbo.fr_tc_far_detail.ttd_pasien2, dbo.fr_tc_far_detail.ttd_pasien3, dbo.fr_tc_far_detail.ttd_pasien4, dbo.fr_tc_far_detail.ttd_pasien5, dbo.fr_tc_far_detail.ttd_pasien_nama1, 
                      dbo.fr_tc_far_detail.ttd_pasien_nama2, dbo.fr_tc_far_detail.ttd_pasien_nama3, dbo.fr_tc_far_detail.ttd_pasien_nama4, dbo.fr_tc_far_detail.ttd_pasien_nama5, dbo.fr_tc_far_detail.perawat1, 
                      dbo.fr_tc_far_detail.perawat2, dbo.fr_tc_far_detail.perawat3, dbo.fr_tc_far_detail.perawat4, dbo.fr_tc_far_detail.perawat5, dbo.fr_tc_far_detail_batal.kd_tr_resep AS Expr1
FROM         dbo.fr_tc_far_detail LEFT OUTER JOIN
                      dbo.fr_tc_far_detail_batal ON dbo.fr_tc_far_detail.kd_tr_resep = dbo.fr_tc_far_detail_batal.kd_tr_resep
WHERE     (dbo.fr_tc_far_detail.kode_trans_far IN
                          (SELECT     kode_trans_far
                            FROM          dbo.fr_tc_far_batal)) AND (dbo.fr_tc_far_detail_batal.kd_tr_resep IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_fr_tc_far_detail_v]");
    }
};
