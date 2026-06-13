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
CREATE OR ALTER PROCEDURE [dbo].[tarik_fr_tc_2far_detail_sp]
	

AS
insert into  fr_tc_2far_detail(kd_tr_resep, kode_trans_far, jumlah_pesan, jumlah_tebus, sisa, jumlah_retur, harga_r_retur, kode_brg, harga_beli, harga_jual, harga_r, biaya_tebus, bill_rs, bill_dr1, bill_dr2, bill_rs_askes, bill_dr1_askes, 
                         bill_dr2_askes, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, status_kirim, status_retur, kode_cito, racik, obat_cover_persh, diskon, kode_diskon, takaran, penggunaan, instruksi, jml_pakai, jml_takar, jml_konversi, tgl_input, 
                         alasan_retur, profit_2_persen, tot_pakai_ri, sisa_pakai_ri, waktu_pakai, bud, komp_dtd, racikan_dr, id_resep_ri_dr, jam1, jam2, jam3, jam4, jam5, tgl_update1, tgl_update2, tgl_update3, tgl_update4, 
                         tgl_update5, id_user1, id_user2, id_user3, id_user4, id_user5


)
 select kd_tr_resep, kode_trans_far, jumlah_pesan, jumlah_tebus, sisa, jumlah_retur, harga_r_retur, kode_brg, harga_beli, harga_jual, harga_r, biaya_tebus, bill_rs, bill_dr1, bill_dr2, bill_rs_askes, bill_dr1_askes, 
                         bill_dr2_askes, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, status_kirim, status_retur, kode_cito, racik, obat_cover_persh, diskon, kode_diskon, takaran, penggunaan, instruksi, jml_pakai, jml_takar, jml_konversi, tgl_input, 
                         alasan_retur, profit_2_persen,  tot_pakai_ri, sisa_pakai_ri, waktu_pakai, bud, komp_dtd, racikan_dr, id_resep_ri_dr, jam1, jam2, jam3, jam4, jam5, tgl_update1, tgl_update2, tgl_update3, tgl_update4, 
                         tgl_update5, id_user1, id_user2, id_user3, id_user4, id_user5

 
 from fr_tc_2far_detail_v 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tarik_fr_tc_2far_detail_sp");
    }
};
