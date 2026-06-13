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
        Schema::create('tc_observasi_bayi_det', function (Blueprint $table) {
            $table->increments('id_det');
            $table->integer('id');
            $table->dateTime('tgl_jam')->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('hr', 50)->nullable();
            $table->string('rr', 50)->nullable();
            $table->string('sp02', 50)->nullable();
            $table->string('asi_cara', 50)->nullable();
            $table->string('sf_cara', 50)->nullable();
            $table->string('residu', 50)->nullable();
            $table->string('muntah', 50)->nullable();
            $table->string('urine', 50)->nullable();
            $table->string('bab', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->integer('no_urut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_observasi_bayi_det');
    }
};
