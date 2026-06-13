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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[up_th_gicu_icu_sp]

@no_registrasi as int

as
update th_gicu_icu set part1=NULL, no_registrasi=NULL;
update th_gicu_icu set part2=NULL, no_registrasi=NULL;
update th_gicu_icu set part3=NULL, no_registrasi=NULL;
update th_gicu_icu set part4=NULL, no_registrasi=NULL;
update th_gicu_icu set part5=NULL, no_registrasi=NULL;
update th_gicu_icu set part6=NULL, no_registrasi=NULL;
update th_gicu_icu set part7=NULL, no_registrasi=NULL;
update th_gicu_icu set part8=NULL, no_registrasi=NULL;
update th_gicu_icu set part9=NULL, no_registrasi=NULL;
update th_gicu_icu set part10=NULL, no_registrasi=NULL;
update th_gicu_icu set part11=NULL, no_registrasi=NULL;
update th_gicu_icu set part12=NULL, no_registrasi=NULL;
update th_gicu_icu set part13=NULL, no_registrasi=NULL;
update th_gicu_icu set part14=NULL, no_registrasi=NULL;
update th_gicu_icu set part15=NULL, no_registrasi=NULL;
update th_gicu_icu set part16=NULL, no_registrasi=NULL;
update th_gicu_icu set part17=NULL, no_registrasi=NULL;
update th_gicu_icu set part18=NULL, no_registrasi=NULL;
update th_gicu_icu set part19=NULL, no_registrasi=NULL;
update th_gicu_icu set part20=NULL, no_registrasi=NULL;
update th_gicu_icu set part21=NULL, no_registrasi=NULL;
update th_gicu_icu set part22=NULL, no_registrasi=NULL;
update th_gicu_icu set part23=NULL, no_registrasi=NULL;
update th_gicu_icu set part24=NULL, no_registrasi=NULL;

-------------------------
update Gicu_update_1_v set no_registrasi_up=no_registrasi,part1=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_2_v set part2=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_3_v set part3=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_4_v set part4=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_5_v set part5=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_6_v set part6=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_7_v set part7=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_8_v set part8=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_9_v set part9=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_10_v set part10=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_11_v set part11=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_12_v set part12=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_13_v set part13=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_14_v set part14=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_15_v set part15=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_16_v set part16=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_17_v set part17=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_18_v set part18=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_19_v set part19=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_20_v set part20=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_21_v set part21=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_22_v set part22=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_23_v set part23=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
update Gicu_update_24_v set part24=hasil, kode_pemeriksaan_det2=kode_pemeriksaan_det where no_registrasi=@no_registrasi;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS up_th_gicu_icu_sp");
    }
};
