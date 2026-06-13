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
        if (Schema::hasTable('tc_observasi')) {
            return;
        }

        Schema::create('tc_observasi', function (Blueprint $table) {
            $table->increments('id_observasi');
            $table->dateTime('tgl_jam')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->text('nama_pasien')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->string('tekan_darah', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('r_r', 50)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('spo', 50)->nullable();
            $table->string('gcs', 50)->nullable();
            $table->string('kesadaran', 50)->nullable();
            $table->text('terapi')->nullable();
            $table->text('tindakan')->nullable();
            $table->string('sekala_nyeri', 50)->nullable();
            $table->integer('id_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_observasi');
    }
};
