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
        DB::unprepared("create proc diskon_flat_perusahaan2

 
@no_registrasi as int
--@kode_perusahaan as char(5),
--@kode_bagian as char(6)
as

UPDATE diskon_flat_ri_v set diskon_rs_jatah=disk_rs, diskon_dr1_jatah=disk_dr1, diskon_dr2_jatah=disk_dr2 Where no_registrasi=@no_registrasi;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS diskon_flat_perusahaan2");
    }
};
