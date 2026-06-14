<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('tc_emr_form_temp')) {
            return;
        }

        Schema::create('tc_emr_form_temp', function (Blueprint $table) {
            $table->increments('id_tc_emr');
            $table->string('no_mr', 10)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->dateTime('tgl_update')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('flag_dr')->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->dateTime('tgl_verif')->nullable();
            $table->dateTime('tgl_imp_askep')->nullable();
            $table->integer('id_user_imp')->nullable();
            $table->text('ttd')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('kode_rm_inp')->nullable();
            $table->integer('kd_dokter_ver')->nullable();
            $table->dateTime('tgl_verif_dok')->nullable();
            $table->integer('flag_ver')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_emr_form_temp');
    }
};
