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
        DB::unprepared("CREATE proc [dbo].[manajemen_bed_sp]


as

update manajemen_bed_update_pu_1_v set pu1_status=status, pu1_jen_kel=jen_kelamin,pu1_klas=nama_klas, pu1_bed=no_bed;
update manajemen_bed_update_pu_2_v set pu2_status=status, pu2_jen_kel=jen_kelamin,pu2_klas=nama_klas, pu2_bed=no_bed;
update manajemen_bed_update_pu_3_v set pu3_status=status, pu3_jen_kel=jen_kelamin,pu3_klas=nama_klas, pu3_bed=no_bed;
update manajemen_bed_update_pu_nifas_v set nifas_status=status, nifas_jen_kel=jen_kelamin,nifas_klas=nama_klas, nifas_bed=no_bed;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS manajemen_bed_sp");
    }
};
