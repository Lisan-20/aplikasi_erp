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
        Schema::create('tc_diagnosa_gizi', function (Blueprint $table) {
            $table->increments('kd_gizi');
            $table->integer('no_kunjungan')->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->string('no_mr', 6)->nullable();
            $table->integer('id_diag_gizi_asupan')->nullable();
            $table->integer('id_diag_gizi_klinis')->nullable();
            $table->integer('id_diag_gizi_prilaku')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('id_diet')->nullable();
            $table->text('asupan')->nullable();
            $table->text('klinis')->nullable();
            $table->text('prilaku')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_diagnosa_gizi');
    }
};
