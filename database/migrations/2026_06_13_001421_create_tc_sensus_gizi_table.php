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
        if (Schema::hasTable('tc_sensus_gizi')) {
            return;
        }

        Schema::create('tc_sensus_gizi', function (Blueprint $table) {
            $table->increments('id_tc_sensus_gizi');
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 6)->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('diet')->nullable();
            $table->text('perubahan_diet')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status_pasien', 2)->nullable();
            $table->dateTime('tgl')->nullable();
            $table->text('alergi')->nullable();
            $table->integer('kode_penunjang')->nullable();
            $table->integer('kode_icd_diagnosa')->nullable();
            $table->string('kode_diet', 6)->nullable();
            $table->text('diagnosa2')->nullable();
            $table->integer('kode_icd_diagnosa2')->nullable();
            $table->text('diagnosa3')->nullable();
            $table->integer('kode_icd_diagnosa3')->nullable();
            $table->string('distribusi2', 50)->nullable();
            $table->integer('distribusi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_sensus_gizi');
    }
};
