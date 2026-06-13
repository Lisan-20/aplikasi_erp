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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_tc_2far_detail_v
AS
SELECT     derivedtbl_1.kd_tr_resep, derivedtbl_1.kd_tr_resep2, derivedtbl_1.kode_trans_far, derivedtbl_1.jumlah_pesan, derivedtbl_1.jumlah_tebus, derivedtbl_1.sisa, derivedtbl_1.jumlah_retur, 
                      derivedtbl_1.harga_r_retur, derivedtbl_1.kode_brg, derivedtbl_1.harga_beli, derivedtbl_1.harga_jual, derivedtbl_1.harga_r, derivedtbl_1.biaya_tebus, derivedtbl_1.bill_rs, derivedtbl_1.bill_dr1, 
                      derivedtbl_1.bill_dr2, derivedtbl_1.bill_rs_askes, derivedtbl_1.bill_dr1_askes, derivedtbl_1.bill_dr2_askes, derivedtbl_1.bill_rs_jatah, derivedtbl_1.bill_dr1_jatah, derivedtbl_1.bill_dr2_jatah, 
                      derivedtbl_1.status_kirim, derivedtbl_1.status_retur, derivedtbl_1.kode_cito, derivedtbl_1.racik, derivedtbl_1.obat_cover_persh, derivedtbl_1.diskon, derivedtbl_1.kode_diskon, derivedtbl_1.takaran,
                       derivedtbl_1.penggunaan, derivedtbl_1.instruksi, derivedtbl_1.jml_pakai, derivedtbl_1.jml_takar, derivedtbl_1.jml_konversi, derivedtbl_1.tgl_input, derivedtbl_1.alasan_retur, 
                      derivedtbl_1.profit_2_persen, derivedtbl_1.komp_dtd, derivedtbl_1.racikan_dr, derivedtbl_1.tot_pakai_ri, derivedtbl_1.sisa_pakai_ri, derivedtbl_1.waktu_pakai, derivedtbl_1.bud, derivedtbl_1.jam1, 
                      derivedtbl_1.jam2, derivedtbl_1.jam3, derivedtbl_1.jam4, derivedtbl_1.jam5, derivedtbl_1.tgl_update1, derivedtbl_1.tgl_update2, derivedtbl_1.tgl_update3, derivedtbl_1.tgl_update4, 
                      derivedtbl_1.tgl_update5, derivedtbl_1.id_user1, derivedtbl_1.id_user2, derivedtbl_1.id_user3, derivedtbl_1.id_user4, derivedtbl_1.id_user5, derivedtbl_1.id_resep_ri_dr, derivedtbl_1.isi_cara, 
                      derivedtbl_1.isi_waktu, derivedtbl_1.isi_signa, derivedtbl_1.tgl_update_rek, derivedtbl_1.id_user_rek, dbo.fr_tc_2far_detail.kd_tr_resep AS Expr1
FROM         OPENQUERY(SVR_back, 'select * from fr_tc_far_detail') AS derivedtbl_1 LEFT OUTER JOIN
                      dbo.fr_tc_2far_detail ON derivedtbl_1.kd_tr_resep = dbo.fr_tc_2far_detail.kd_tr_resep
WHERE     (dbo.fr_tc_2far_detail.kd_tr_resep IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_2far_detail_v]");
    }
};
