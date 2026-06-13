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

CREATE proc [dbo].[semi_jurnal_BPJS_RI_sp]
as
--rawat inap BPJS
exec inp_tran_sed_BPJS_RI_sp;
exec inp_tran_sed_far_BPJS_RI_sp;
exec inp_tran_sed_adm_BPJS_RI_sp;
exec inp_tran_sed_adm_far_BPJS_RI_sp;
exec inp_tran_sed_dokter_BPJS_RI_sp;

exec inp_tran_selisih_BPJS_RI_sp;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS semi_jurnal_BPJS_RI_sp");
    }
};
