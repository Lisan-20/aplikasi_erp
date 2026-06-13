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
        DB::unprepared("CREATE proc [dbo].[upd_tran_sed_kasir_sp]
as
update tran_kasir set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian where kel_jurnal=1 and tx_tipe='D');
update tran_sed set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian where kel_jurnal=1 and tx_tipe='K');


update tc_trans_kasir set flag_jurnal=1 where flag_jurnal=0 and kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian where kel_jurnal=1 and tx_tipe='D');
update tc_trans_pelayanan set flag_jurnal=1 where flag_jurnal=0 and kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian where kel_jurnal=1 and tx_tipe='K');
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_tran_sed_kasir_sp");
    }
};
