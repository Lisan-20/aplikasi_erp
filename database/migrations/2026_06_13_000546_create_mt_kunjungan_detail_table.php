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
        if (Schema::hasTable('mt_kunjungan_detail')) {
            return;
        }

        Schema::create('mt_kunjungan_detail', function (Blueprint $table) {
            $table->increments('id_mt_kunjungan_detail');
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->smallInteger('status_selesai')->nullable();
            $table->dateTime('tgl')->nullable();
            $table->smallInteger('status_batal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kunjungan_detail');
    }
};
