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
        DB::unprepared("CREATE proc [dbo].[tc_pemeriksaan_askep_sp]
@no_registrasi as bigint


as

truncate table tc_pemeriksaan_askep_temp;

insert into tc_pemeriksaan_askep_temp( id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, hasil, hasil2,  kd_kk, id_triase, 
                        kd_ref, ket_hasil, no_registrasi

)
select  id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, hasil, hasil2, kd_kk,  id_triase,  
                          kd_ref, ket_hasil, no_registrasi


from tc_pemeriksaan_erm_v  where no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tc_pemeriksaan_askep_sp");
    }
};
