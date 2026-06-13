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

CREATE OR ALTER PROCEDURE [dbo].[semi_jurnal_partik_RJ_sp]
as
exec inp_tran_kasir_RJ_sp;
exec inp_tran_sed_RJ_sp;--3
exec inp_tran_sed_farmasi_RJ_sp;--
exec inp_tran_sed_adm_RJ_sp;
--exec inp_tran_sed_adm_far_RJ_sp; -- ga dipake yaa..
exec inp_tran_sed_dokter_RJ_sp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS semi_jurnal_partik_RJ_sp");
    }
};
