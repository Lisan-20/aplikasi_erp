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
        Schema::create('CHECKINOUT_OK', function (Blueprint $table) {
            $table->integer('USERID');
            $table->dateTime('CHECKTIME');
            $table->string('CHECKTYPE', 50)->nullable();
            $table->integer('VERIFYCODE')->nullable();
            $table->string('SENSORID', 50)->nullable();
            $table->text('Memoinfo')->nullable();
            $table->integer('WorkCode')->nullable();
            $table->string('sn', 50)->nullable();
            $table->integer('UserExtFmt')->nullable();
            $table->integer('id_check')->nullable();
            $table->integer('npp')->nullable();
            $table->integer('kode_shift')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CHECKINOUT_OK');
    }
};
