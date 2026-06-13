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
        Schema::create('th_penjelasan_dr', function (Blueprint $table) {
            $table->increments('id_penjelasan_dr');
            $table->dateTime('tgl_jam_input')->nullable();
            $table->string('penjelasan_dr', 250)->nullable();
            $table->string('keluarga1', 50)->nullable();
            $table->string('keluarga2', 50)->nullable();
            $table->integer('kode_param1')->nullable();
            $table->integer('kode_param2')->nullable();
            $table->integer('kode_dr')->nullable();
            $table->integer('user_input')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_kunjungan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_penjelasan_dr');
    }
};
