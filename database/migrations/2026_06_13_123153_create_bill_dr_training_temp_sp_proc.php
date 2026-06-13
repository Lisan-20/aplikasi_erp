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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[bill_dr_training_temp_sp]

@no_registrasi as int

as
-- pasien umum

update tc_trans_pelayanan set bill_rs=bill_dr1+bill_rs where no_registrasi=@no_registrasi and kode_dokter1='273';
update tc_trans_pelayanan set bill_dr1=0 where no_registrasi=@no_registrasi and kode_dokter1='273';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS bill_dr_training_temp_sp");
    }
};
