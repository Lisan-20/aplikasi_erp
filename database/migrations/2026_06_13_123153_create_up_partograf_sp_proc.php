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
        DB::unprepared("CREATE proc [dbo].[up_partograf_sp]

@no_registrasi as int

as
update th_partograf set part1=NULL, no_registrasi=NULL;
update th_partograf set part2=NULL, no_registrasi=NULL;
update th_partograf set part3=NULL, no_registrasi=NULL;
update th_partograf set part4=NULL, no_registrasi=NULL;
update th_partograf set part5=NULL, no_registrasi=NULL;
update th_partograf set part6=NULL, no_registrasi=NULL;
update th_partograf set part7=NULL, no_registrasi=NULL;
update th_partograf set part8=NULL, no_registrasi=NULL;
update th_partograf set part9=NULL, no_registrasi=NULL;
update th_partograf set part10=NULL, no_registrasi=NULL;
update th_partograf set part11=NULL, no_registrasi=NULL;
update th_partograf set part12=NULL, no_registrasi=NULL;
update th_partograf set part13=NULL, no_registrasi=NULL;
update th_partograf set part14=NULL, no_registrasi=NULL;
update th_partograf set part15=NULL, no_registrasi=NULL;
update th_partograf set part16=NULL, no_registrasi=NULL;

-------------------------
update up_partograf_1_v set no_registrasi_up=no_registrasi,part1=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_2_v set part2=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_3_v set part3=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_4_v set part4=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_5_v set part5=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_6_v set part6=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_7_v set part7=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_8_v set part8=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_9_v set part9=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_10_v set part10=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_11_v set part11=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_12_v set part12=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_13_v set part13=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_14_v set part14=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_15_v set part15=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update up_partograf_16_v set part16=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS up_partograf_sp");
    }
};
