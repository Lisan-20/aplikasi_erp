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
CREATE OR ALTER PROCEDURE [dbo].[batal_tc_kunjungan_sp]
	

AS
insert into  tc_kunjungan_batal(id_tc_kunjungan, no_kunjungan, no_registrasi, no_mr, kode_dokter, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, keterangan, 
                      status_batal, flag_um, kode_tc_trans_kasir, tgl_blpl, tgl_pulang, flag_icd, user_pulang, status_blpl, flag_fisio, user_batal, kode_bagian_batal, flag_titipan, status_triase, tgl_kontrol, flag_wa, 
                      flag_serah, tgl_serah, no_induk, ttd_resum, tgl_jam_ttd, nama_wali_resum


)
 select   id_tc_kunjungan, no_kunjungan, no_registrasi, no_mr, kode_dokter, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, keterangan, 
                      status_batal, flag_um, kode_tc_trans_kasir, tgl_blpl, tgl_pulang, flag_icd, user_pulang, status_blpl, flag_fisio, user_batal, kode_bagian_batal, flag_titipan, status_triase, tgl_kontrol, flag_wa, 
                      flag_serah, tgl_serah, no_induk, ttd_resum, tgl_jam_ttd, nama_wali_resum


 
 from batal_tc_kunjungan_v


 ---- Hapus tc_registrasi
 delete tc_kunjungan where id_tc_kunjungan in (select id_tc_kunjungan from tc_kunjungan_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_tc_kunjungan_sp");
    }
};
