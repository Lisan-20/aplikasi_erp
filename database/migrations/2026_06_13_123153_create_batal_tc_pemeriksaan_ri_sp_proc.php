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
create PROCEDURE [dbo].[batal_tc_pemeriksaan_ri_sp]
	

AS
insert into  tc_pemeriksaan_ri_batal(  kode_tc_periksa, id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, ket, hasil, hasil2, no_urut_entry, kd_kk, no_registrasi, id_info, ket_hasil_bmi, 
                      no_mr, id_triase, sekor, kode_rm, no_urut_ews, no_urut, tgl_update



)
 select  kode_tc_periksa, id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, ket, hasil, hasil2, no_urut_entry, kd_kk, no_registrasi, id_info, ket_hasil_bmi, 
                      no_mr, id_triase, sekor, kode_rm, no_urut_ews, no_urut, tgl_update


 
 from batal_tc_pemeriksaan_ri_v


 ---- Hapus tc_registrasi
 delete tc_pemeriksaan_ri where kode_tc_periksa in (select kode_tc_periksa from tc_pemeriksaan_ri_batal)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batal_tc_pemeriksaan_ri_sp");
    }
};
