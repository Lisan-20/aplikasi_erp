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
create PROCEDURE [dbo].[batal_fr_tc_far_sp]
	

AS
insert into  fr_tc_far_batal( kode_trans_far, kode_pesan_resep, kode_form_ri, kode_form_rj, kode_form_rl, kode_form_bb, no_resep, kode_profit, kode_bagian, tgl_trans, kode_bagian_asal, no_mr, no_registrasi, 
                      no_kunjungan, kode_dokter, dokter_pengirim, nama_pasien, alamat_pasien, telpon_pasien, status_transaksi, petugas, npp, kode_form_baksos, flag_serah, tgl_serah, user_serah, kode_klas, 
                      penerima, flag_resep, online, konfirmasi, stat_dr, no_reg_resep, flag_selesai, user_selesai, tgl_selesai, ttd_serah, kode_trans_far_lama, kode_paket, kode_resep, tgl_status_transaksi, 
                      id_user_status, flag_obt_plang, flag_perawat



)
 select kode_trans_far, kode_pesan_resep, kode_form_ri, kode_form_rj, kode_form_rl, kode_form_bb, no_resep, kode_profit, kode_bagian, tgl_trans, kode_bagian_asal, no_mr, no_registrasi, 
                      no_kunjungan, kode_dokter, dokter_pengirim, nama_pasien, alamat_pasien, telpon_pasien, status_transaksi, petugas, npp, kode_form_baksos, flag_serah, tgl_serah, user_serah, kode_klas, 
                      penerima, flag_resep, online, konfirmasi, stat_dr, no_reg_resep, flag_selesai, user_selesai, tgl_selesai, ttd_serah, kode_trans_far_lama, kode_paket, kode_resep, tgl_status_transaksi, 
                      id_user_status, flag_obt_plang, flag_perawat

 
 from batal_fr_tc_far_v


 ---- Hapus tc_registrasi
 delete fr_tc_far where kode_trans_far in (select kode_trans_far from fr_tc_far_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_fr_tc_far_sp");
    }
};
