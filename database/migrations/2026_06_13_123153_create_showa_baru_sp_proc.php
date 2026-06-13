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
CREATE proc [dbo].[showa_baru_sp]

@no_registrasi int

as
DELETE tc_diskon_showa WHERE no_registrasi=@no_registrasi;
insert into tc_diskon_showa (no_registrasi, diskon, no_mr, kode_perusahaan, diskon_persen, billing)
SELECT     no_registrasi, diskon, no_mr, kode_perusahaan, diskon_rj as diskon_persen, billing
from tc_diskon_showa_v Where no_registrasi not in(select no_registrasi from tc_diskon_showa)
AND no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS showa_baru_sp");
    }
};
