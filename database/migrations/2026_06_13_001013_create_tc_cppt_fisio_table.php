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
        if (Schema::hasTable('tc_cppt_fisio')) {
            return;
        }

        Schema::create('tc_cppt_fisio', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->text('hp_s')->nullable();
            $table->text('hp_o')->nullable();
            $table->text('hp_a')->nullable();
            $table->text('hp_p')->nullable();
            $table->text('instruksi')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt_fisio');
    }
};
