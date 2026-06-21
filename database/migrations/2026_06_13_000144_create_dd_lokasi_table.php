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
        if (Schema::hasTable('dd_lokasi')) {
            return;
        }

        Schema::create('dd_lokasi', function (Blueprint $table) {
            $table->increments('id_dd_lokasi');
            $table->integer('kode_lantai');
            $table->string('kode_lokasi', 10);
            $table->string('nama_singkat', 10);
            $table->string('nama_lengkap', 30);
            $table->decimal('luas_lantai', 10);
            $table->decimal('area_umum', 10)->nullable();
            $table->string('keterangan', 250)->nullable();
            $table->integer('ko_wil');
            $table->string('fungsi', 50);
            $table->dateTime('tgl_berlaku')->nullable();
            $table->smallInteger('input_id');
            $table->dateTime('input_tgl');
            $table->tinyInteger('status');
            $table->dateTime('status_tgl');

            $table->primary(['id_dd_lokasi'], 'pk_bmdd_lantai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_lokasi');
    }
};
