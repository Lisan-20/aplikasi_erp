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
        DB::unprepared("CREATE proc update_bedah_cito_sp
@no_registrasi int

as
update v_upd_cito_bedah set bill_rs=(bill_rs+bill_rs_upd),bill_dr1=(bill_dr1+bill_dr1_upd),bill_dr2=(bill_dr2+bill_dr2_upd) where no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS update_bedah_cito_sp");
    }
};
