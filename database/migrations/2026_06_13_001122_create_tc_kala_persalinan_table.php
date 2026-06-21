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
        if (Schema::hasTable('tc_kala_persalinan')) {
            return;
        }

        Schema::create('tc_kala_persalinan', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('jam_ke')->nullable();
            $table->string('tekanan_darah', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('temp', 50)->nullable();
            $table->string('tinggi_fundus', 50)->nullable();
            $table->string('kontraksi', 50)->nullable();
            $table->string('kandung', 50)->nullable();
            $table->string('perdarahan', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_rm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kala_persalinan');
    }
};
