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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[upd_trans_pelayanan]

@no_registrasi as int

as
-- pasien umum

update tc_trans_pelayanan set status_selesai=2  where no_registrasi=@no_registrasi and status_selesai < 2;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS upd_trans_pelayanan");
    }
};
