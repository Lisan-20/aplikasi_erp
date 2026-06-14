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
        if (Schema::hasTable('dd_user_lama')) {
            return;
        }

        Schema::create('dd_user_lama', function (Blueprint $table) {
            $table->integer('id_dd_user');
            $table->string('username', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->string('npp', 20)->nullable();
            $table->string('no_induk', 20)->nullable();
            $table->integer('id_dd_group')->nullable();
            $table->integer('id_dd_user_group')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('ko_wil')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('id_dd_jenis_user')->nullable();
            $table->string('no_id_jenis', 20)->nullable();
            $table->string('bahasa', 50)->nullable();
            $table->string('blokir', 1)->nullable();
            $table->dateTime('tgl_daftar')->nullable();
            $table->string('level', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('nama_lengkap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_user_lama');
    }
};
