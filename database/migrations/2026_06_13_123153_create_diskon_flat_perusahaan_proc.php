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
        DB::unprepared("CREATE proc [dbo].[diskon_flat_perusahaan]

 
@no_registrasi as int
--@kode_perusahaan as char(5),
--@kode_bagian as char(6)
as

UPDATE diskon_flat_rj_v set diskon_rs_jatah=disk_rs, diskon_dr1_jatah=disk_dr1, diskon_dr2_jatah=disk_dr2 Where no_registrasi=@no_registrasi;

INSERT INTO tc_diskon_showa( no_registrasi, diskon, no_mr, kode_perusahaan, diskon_persen,billing) 
select no_registrasi, diskon, no_mr, kode_perusahaan, diskon_rj as diskon_persen,billing from tc_diskon_showa_v Where no_registrasi=@no_registrasi AND no_registrasi not in(select no_registrasi from tc_diskon_showa);");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS diskon_flat_perusahaan");
    }
};
