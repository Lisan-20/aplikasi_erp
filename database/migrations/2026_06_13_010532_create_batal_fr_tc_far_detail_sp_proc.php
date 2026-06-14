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
        DB::unprepared("
CREATE OR ALTER PROCEDURE [dbo].[batal_fr_tc_far_detail_sp]
	

AS
insert into  fr_tc_far_detail_batal( kd_tr_resep, kode_trans_far, jumlah_pesan, jumlah_tebus, sisa, jumlah_retur, harga_r_retur, kode_brg, harga_beli, harga_jual, harga_r, biaya_tebus, bill_rs, bill_dr1, bill_dr2, bill_rs_askes, 
                      bill_dr1_askes, bill_dr2_askes, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, status_kirim, status_retur, kode_cito, racik, obat_cover_persh, diskon, kode_diskon, takaran, penggunaan, instruksi, 
                      jml_pakai, jml_takar, jml_konversi, tgl_input, alasan_retur, profit_2_persen, komp_dtd, racikan_dr, tot_pakai_ri, sisa_pakai_ri, waktu_pakai, bud, jam1, jam2, jam3, jam4, jam5, tgl_update1, 
                      tgl_update2, tgl_update3, tgl_update4, tgl_update5, id_user1, id_user2, id_user3, id_user4, id_user5, id_resep_ri_dr, isi_cara, isi_waktu, isi_signa, tgl_update_rek, id_user_rek, ttd_pasien1, 
                      ttd_pasien2, ttd_pasien3, ttd_pasien4, ttd_pasien5, ttd_pasien_nama1, ttd_pasien_nama2, ttd_pasien_nama3, ttd_pasien_nama4, ttd_pasien_nama5, perawat1, perawat2, perawat3, perawat4, 
                      perawat5




)
 select kd_tr_resep, kode_trans_far, jumlah_pesan, jumlah_tebus, sisa, jumlah_retur, harga_r_retur, kode_brg, harga_beli, harga_jual, harga_r, biaya_tebus, bill_rs, bill_dr1, bill_dr2, bill_rs_askes, 
                      bill_dr1_askes, bill_dr2_askes, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, status_kirim, status_retur, kode_cito, racik, obat_cover_persh, diskon, kode_diskon, takaran, penggunaan, instruksi, 
                      jml_pakai, jml_takar, jml_konversi, tgl_input, alasan_retur, profit_2_persen, komp_dtd, racikan_dr, tot_pakai_ri, sisa_pakai_ri, waktu_pakai, bud, jam1, jam2, jam3, jam4, jam5, tgl_update1, 
                      tgl_update2, tgl_update3, tgl_update4, tgl_update5, id_user1, id_user2, id_user3, id_user4, id_user5, id_resep_ri_dr, isi_cara, isi_waktu, isi_signa, tgl_update_rek, id_user_rek, ttd_pasien1, 
                      ttd_pasien2, ttd_pasien3, ttd_pasien4, ttd_pasien5, ttd_pasien_nama1, ttd_pasien_nama2, ttd_pasien_nama3, ttd_pasien_nama4, ttd_pasien_nama5, perawat1, perawat2, perawat3, perawat4, 
                      perawat5


 
 from batal_fr_tc_far_detail_v


 ---- Hapus tc_registrasi
 delete fr_tc_far_detail where kode_trans_far in (select kode_trans_far from fr_tc_far_detail_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_fr_tc_far_detail_sp");
    }
};
