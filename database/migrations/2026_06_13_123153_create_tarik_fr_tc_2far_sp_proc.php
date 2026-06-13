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
CREATE PROCEDURE [dbo].[tarik_fr_tc_2far_sp]
	

AS
insert into  fr_tc_2far(kode_trans_far, kode_pesan_resep, kode_form_ri, kode_form_rj, kode_form_rl, kode_form_bb, no_resep, kode_profit, kode_bagian, tgl_trans, kode_bagian_asal, no_mr, no_kunjungan, kode_dokter, 
                         dokter_pengirim, nama_pasien, alamat_pasien, telpon_pasien, status_transaksi, petugas, npp, kode_form_baksos, flag_serah, tgl_serah, user_serah, kode_klas, penerima, flag_resep, online, konfirmasi, stat_dr, 
                         no_registrasi, no_reg_resep, flag_selesai, user_selesai, tgl_selesai, ttd_serah, kode_trans_far_lama,  flag_obt_plang

)
 select kode_trans_far, kode_pesan_resep, kode_form_ri, kode_form_rj, kode_form_rl, kode_form_bb, no_resep, kode_profit, kode_bagian, tgl_trans, kode_bagian_asal, no_mr, no_kunjungan, kode_dokter, 
                         dokter_pengirim, nama_pasien, alamat_pasien, telpon_pasien, status_transaksi, petugas, npp, kode_form_baksos, flag_serah, tgl_serah, user_serah, kode_klas, penerima, flag_resep, online, konfirmasi, stat_dr, 
                        no_registrasi, no_reg_resep, flag_selesai, user_selesai, tgl_selesai, ttd_serah, kode_trans_far_lama, flag_obt_plang

 
 from fr_tc_2far_v ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tarik_fr_tc_2far_sp");
    }
};
