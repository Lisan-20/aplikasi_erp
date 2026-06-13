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
        DB::unprepared("CREATE proc [dbo].[diskon_showa_sp_ri]
 @no_registrasi as int

as

begin


UPDATE bill_ri_showa_update_sp_v2 set diskon_rs_jatah=diskon_total,diskon_dr1_jatah=0,diskon_dr2_jatah=0 WHERE no_registrasi=@no_registrasi;

end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS diskon_showa_sp_ri");
    }
};
