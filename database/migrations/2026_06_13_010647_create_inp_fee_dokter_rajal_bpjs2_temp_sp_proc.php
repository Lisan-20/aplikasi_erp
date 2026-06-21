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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_fee_dokter_rajal_bpjs2_temp_sp]
@kode_trans_pelayanan as int,
@fee_dokter as int

as

update fee_dokter_rajal_temp set fee_bpjs=@fee_dokter where kode_trans_pelayanan=@kode_trans_pelayanan ;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_rajal_bpjs2_temp_sp");
    }
};
