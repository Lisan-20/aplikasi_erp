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
        DB::unprepared("CREATE OR ALTER PROCEDURE update_trans_pelayanan_sp
as
update update_trans_pelayanan_RJ_v set flag_jurnal=1 where flag_jurnal=1;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS update_trans_pelayanan_sp");
    }
};
