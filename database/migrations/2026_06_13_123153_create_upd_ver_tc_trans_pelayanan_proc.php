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
        DB::unprepared("CREATE proc [dbo].[upd_ver_tc_trans_pelayanan]
@no_induk as int,
@kode_tc_trans_kasir as int
as

update tc_trans_pelayanan set flag_jurnal=0 , tgl_ver=GETDATE() where kode_tc_trans_kasir in (select kode_tc_trans_kasir from tc_trans_kasir where no_kuitansi_bendahara is null);
--pasien bpjs murni
--delete tc_trans_jkn where no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_ver_tc_trans_pelayanan");
    }
};
