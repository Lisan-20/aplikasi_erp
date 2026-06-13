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
        DB::unprepared("CREATE proc [dbo].[tc_pemeriksaan_ri_dokter_sp]
@no_registrasi as varchar(15)


as

truncate table tc_pemeriksaan_ri_dokter_temp;

insert into tc_pemeriksaan_ri_dokter_temp(id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, ket, hasil, hasil2,  kd_kk, no_registrasi, no_mr, id_triase, 
                          kode_rm, no_urut_ews, no_urut, tgl_update, kd_ref


)
select id_mt_kd, kode_bagian, no_kunjungan, kode_pemeriksaan, nama_pemeriksaan, kd_lev, kd_type, ket, hasil, hasil2, kd_kk, no_registrasi, no_mr, id_triase, 
                         kode_rm, no_urut_ews, no_urut, tgl_update, kd_ref

						 
from tc_pemeriksaan_ri_dokter_v where no_registrasi=@no_registrasi;


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tc_pemeriksaan_ri_dokter_sp");
    }
};
