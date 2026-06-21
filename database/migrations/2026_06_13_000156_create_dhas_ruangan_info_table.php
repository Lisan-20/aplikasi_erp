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
        if (Schema::hasTable('dhas_ruangan_info')) {
            return;
        }

        Schema::create('dhas_ruangan_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pu1_kode_ruangan', 100)->nullable();
            $table->integer('pu1_no_urut')->nullable();
            $table->text('pu1_status')->nullable();
            $table->string('pu1_jen_kel', 10)->nullable();
            $table->string('pu2_kode_ruangan', 100)->nullable();
            $table->integer('pu2_no_urut')->nullable();
            $table->text('pu2_status')->nullable();
            $table->string('pu2_jen_kel', 10)->nullable();
            $table->string('pu3_kode_ruangan', 100)->nullable();
            $table->integer('pu3_no_urut')->nullable();
            $table->text('pu3_status')->nullable();
            $table->string('pu3_jen_kel', 10)->nullable();
            $table->string('nifas_kode_ruangan', 100)->nullable();
            $table->integer('nifas_no_urut')->nullable();
            $table->text('nifas_status')->nullable();
            $table->string('nifas_jen_kel', 10)->nullable();
            $table->string('pu1_klas', 50)->nullable();
            $table->string('pu2_klas', 50)->nullable();
            $table->string('pu3_klas', 50)->nullable();
            $table->string('nifas_klas', 50)->nullable();
            $table->string('pu1_bed', 150)->nullable();
            $table->string('pu2_bed', 150)->nullable();
            $table->string('pu3_bed', 150)->nullable();
            $table->string('nifas_bed', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dhas_ruangan_info');
    }
};
