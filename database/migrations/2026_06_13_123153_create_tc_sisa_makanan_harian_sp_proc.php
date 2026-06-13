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
        DB::unprepared("CREATE proc [dbo].[tc_sisa_makanan_harian_sp]
as


INSERT INTO tc_sisa_makanan_ri (tgl_hari_ini, tgl_masuk, no_mr, no_registrasi, nama_pasien, nama_bagian_depo) 
SELECT getdate() as tgl_hari_ini, tgl_masuk, no_mr, no_registrasi, nama_pasien, nama_bagian_depo

From daftar_pasien_ri_v where no_registrasi not in (select no_registrasi from tc_sisa_makanan_ri where convert(varchar, tgl_hari_ini, 101)=convert(varchar, getdate(), 101))


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tc_sisa_makanan_harian_sp");
    }
};
