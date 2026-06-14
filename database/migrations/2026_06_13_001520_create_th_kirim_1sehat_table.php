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
        if (Schema::hasTable('th_kirim_1sehat')) {
            return;
        }

        Schema::create('th_kirim_1sehat', function (Blueprint $table) {
            $table->increments('id_kirim');
            $table->string('no_mr', 50)->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->text('encounter')->nullable();
            $table->text('condition')->nullable();
            $table->text('observation')->nullable();
            $table->text('procedure')->nullable();
            $table->text('composition')->nullable();
            $table->text('allergyIntolerance')->nullable();
            $table->text('clinicalImpression')->nullable();
            $table->text('serviceRequest')->nullable();
            $table->text('medicationRequest')->nullable();
            $table->text('medicationDispense')->nullable();
            $table->text('specimen')->nullable();
            $table->text('diagnosticReport')->nullable();
            $table->text('immunization')->nullable();
            $table->text('hasilFase2')->nullable();
            $table->text('hasilFase1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_kirim_1sehat');
    }
};
