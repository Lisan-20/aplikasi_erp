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
        DB::unprepared("CREATE proc [dbo].[upd_flag_tagih_sp]
@kode_tc_trans_kasir as int,
--@kode_perusahaan as int,
@no_induk as int

as
update tc_trans_kasir set flag_tagih=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir and flag_tagih is null ;--kode_perusahaan=@kode_perusahaan and 
update tc_trans_kasir set flag_tagih_penanggung=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir and flag_tagih_penanggung is null ;--kode_penanggung=@kode_perusahaan and 

--update tc_trans_pelayanan set flag_jurnal=0,tgl_ver=GETDATE() where kode_tc_trans_kasir=@kode_tc_trans_kasir and flag_jurnal is null ;
--update tc_trans_kasir set flag_jurnal=0,tgl_ver=GETDATE() where kode_tc_trans_kasir=@kode_tc_trans_kasir and flag_jurnal is null ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_flag_tagih_sp");
    }
};
