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
        if (Schema::hasTable('tc_jatah_lembur')) {
            return;
        }

        Schema::create('tc_jatah_lembur', function (Blueprint $table) {
            $table->increments('id_tc_jatah_lembur');
            $table->text('npp')->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('jatah_lembur_hari')->nullable();
            $table->decimal('tarif_lembur_hari', 18)->nullable();
            $table->integer('jatah_lembur_jam')->nullable();
            $table->decimal('tarif_lembur_jam', 18)->nullable();
            $table->decimal('tarif_uang_makan', 18)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_jatah_lembur');
    }
};
