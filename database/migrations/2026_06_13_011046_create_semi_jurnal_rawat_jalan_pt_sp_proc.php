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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[semi_jurnal_rawat_jalan_pt_sp]
as
exec inp_tran_sed_pt_RJ_sp;
exec inp_tran_sed_far_pt_RJ_sp;
exec inp_tran_sed_adm_pt_RJ_sp;
--exec inp_tran_sed_adm_far_pt_RJ_sp;ga dipake yaa..
exec inp_tran_sed_dokter_pt_RJ_sp;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS semi_jurnal_rawat_jalan_pt_sp");
    }
};
