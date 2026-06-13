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
        DB::unprepared("create proc sp_lap_piut

as

truncate table tc_lap_posisi_piutang;

insert into tc_lap_posisi_piutang(kode_perusahaan,acc_no,bln,thn,tx_tipe,tx_nominal)

select 
kode_perusahaan,acc_no,bln,thn,tx_tipe,tx_nominal
from v_sum_lap_piutang Where acc_no='1130104';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_lap_piut");
    }
};
