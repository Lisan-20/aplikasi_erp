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
        Schema::create('tc_observasi_bayi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('no_urut')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->text('masalah_aktif')->nullable();
            $table->text('intake')->nullable();
            $table->text('terapi')->nullable();
            $table->string('po', 50)->nullable();
            $table->string('iv', 50)->nullable();
            $table->string('cm', 50)->nullable();
            $table->string('ck', 50)->nullable();
            $table->string('iwl', 50)->nullable();
            $table->string('deurisis', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_observasi_bayi');
    }
};
