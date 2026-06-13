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
        DB::unprepared("CREATE proc [dbo].[upd_billing_RI_sp]
as
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='RI' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed);
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='RI' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir);
update upd_trans_pelayanan_v set flag_jurnal=1 where seri_kuitansi='AI' and flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed);
update upd_tran_kasir_v set flag_jurnal=1 where seri_kuitansi='AI' and flag_jurnal=0 and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tran_kasir);


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_billing_RI_sp");
    }
};
