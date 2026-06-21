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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[ri_tc_ranap_ins]
@no_kunjungan int

as


insert into   ri_tc_rawatinap(no_kunjungan, jatah_klas, kelas_pas, kode_ruangan, bag_pas, tgl_masuk, dr_merawat, user_dtg, input_tgl, diagnosa_awal, no_jkn)
select no_kunjungan,kode_klas,kode_klas,no_bed,kode_bagian,tgl_transaksi, kode_dokter, no_induk, tgl_input, diagnosa, no_jaminan
from upd_ri_tc_ranap_v where no_kunjungan=@no_kunjungan;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ri_tc_ranap_ins");
    }
};
