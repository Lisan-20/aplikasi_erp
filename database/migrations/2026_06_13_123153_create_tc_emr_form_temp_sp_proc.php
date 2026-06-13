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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[tc_emr_form_temp_sp]
@no_registrasi as varchar(50)


as

truncate table tc_emr_form_temp;

insert into tc_emr_form_temp( no_mr, no_registrasi, no_kunjungan, kode_rm, tgl_update, kode_bagian, id_user, tgl_imp_askep, id_user_imp, no_urut, kode_rm_inp

)
select  no_mr, no_registrasi, no_kunjungan, kode_rm, tgl_update, kode_bagian, id_user, tgl_imp_askep, id_user_imp, no_urut, kode_rm_inp



from tc_emr_form  where no_registrasi=@no_registrasi;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tc_emr_form_temp_sp");
    }
};
