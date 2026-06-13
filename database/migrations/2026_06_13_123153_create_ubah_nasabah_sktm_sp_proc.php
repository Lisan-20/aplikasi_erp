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
        DB::unprepared("CREATE OR ALTER PROCEDURE dbo.ubah_nasabah_sp
@no_registrasi as int

as
update tc_registrasi set kode_kelompok=6 where no_registrasi=@no_registrasi;
update tc_trans_pelayanan set kode_kelompok=6 where no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ubah_nasabah_sktm_sp");
    }
};
