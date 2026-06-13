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
        if (Schema::hasTable('th_kirim_hasil_wa')) {
            return;
        }

        Schema::create('th_kirim_hasil_wa', function (Blueprint $table) {
            $table->increments('id_th');
            $table->string('no_mr', 50)->nullable();
            $table->integer('kode_tc_hasilpenunjang')->nullable();
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->integer('kode_penunjang')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->integer('user_kirim')->nullable();
            $table->integer('flag_wa')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->string('no_tlp', 50)->nullable();
            $table->dateTime('tgl_periksa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_kirim_hasil_wa');
    }
};
