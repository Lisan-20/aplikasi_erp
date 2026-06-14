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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_far_new_exec_sp]
@bln as int,
@thn as int

as

exec lap_kunjungan_far_new_sp @bln,@thn;
exec dbo.lap_kunjungan_far_new2_sp @bln,@thn;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_far_new_exec_sp");
    }
};
