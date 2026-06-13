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
        if (Schema::hasTable('mt_kinerja_penilaian')) {
            return;
        }

        Schema::create('mt_kinerja_penilaian', function (Blueprint $table) {
            $table->increments('id_kinerja');
            $table->integer('kelompok_kinerja')->nullable();
            $table->string('ket_kinerja', 100)->nullable();
            $table->integer('id_bobot')->nullable();
            $table->integer('nilai_min')->nullable();
            $table->integer('nilai_maks')->nullable();
            $table->dateTime('tgl_awal')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->tinyInteger('status_kinerja')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->text('kelompok_kinerja3')->nullable();
            $table->text('bobot3')->nullable();
            $table->decimal('bobot4', 18, 0)->nullable();
            $table->float('bobot', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kinerja_penilaian');
    }
};
