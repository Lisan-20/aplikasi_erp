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

CREATE OR ALTER PROCEDURE [dbo].[semi_jurnal_partik_RI_sp]
as
--rawat inap partikelir
exec inp_tran_sed_adm_RI_sp;
exec inp_tran_sed_RI_sp;
exec inp_tran_sed_farmasi_RI_sp;
exec inp_tran_sed_adm_far_RI_sp;
exec inp_tran_sed_dokter_RI_sp;
UPDATE tc_trans_pelayanan set flag_jurnal=1 where flag_jurnal=0 and kode_trans_pelayanan in (select kode_trans_pelayanan from tran_sed where kode_inap>0);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS semi_jurnal_partik_RI_sp");
    }
};
