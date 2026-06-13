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
        DB::unprepared("CREATE proc [dbo].[inp_fee_dokter_bedah_bpjs2_temp_sp]
@kode_trans_pelayanan as int,
@fee_dokter as int

--@kode_dokter as int,
--@tgl_mulai_db as varchar(20),
--@tgl_akhir_db as varchar(20)


as

update fee_dokter_rinap_temp set fee_bpjs=@fee_dokter where kode_trans_pelayanan=@kode_trans_pelayanan ;
--update fee_bedah_bpjs_trial3_v set fee_bpjs=fee_bpjs where fee>0 AND (tgl_kuitansi BETWEEN @tgl_mulai_db AND @tgl_akhir_db) and (flag_sppu is NULL) and no_sppu is NULL and kode_dr=@kode_dokter");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_bedah_bpjs2_temp_sp");
    }
};
