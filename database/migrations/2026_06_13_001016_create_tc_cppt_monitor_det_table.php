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
        if (Schema::hasTable('tc_cppt_monitor_det')) {
            return;
        }

        Schema::create('tc_cppt_monitor_det', function (Blueprint $table) {
            $table->increments('id_kd');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kd_pemeriksaan')->nullable();
            $table->decimal('kd_07', 19, 4)->nullable();
            $table->decimal('kd_08', 19, 4)->nullable();
            $table->decimal('kd_09', 19, 4)->nullable();
            $table->decimal('kd_10', 19, 4)->nullable();
            $table->decimal('kd_11', 19, 4)->nullable();
            $table->decimal('kd_12', 19, 4)->nullable();
            $table->decimal('kd_13', 19, 4)->nullable();
            $table->decimal('kd_14', 19, 4)->nullable();
            $table->decimal('kd_15', 19, 4)->nullable();
            $table->decimal('kd_16', 19, 4)->nullable();
            $table->decimal('kd_17', 19, 4)->nullable();
            $table->decimal('kd_18', 19, 4)->nullable();
            $table->decimal('kd_19', 19, 4)->nullable();
            $table->decimal('kd_20', 19, 4)->nullable();
            $table->decimal('kd_21', 19, 4)->nullable();
            $table->decimal('kd_22', 19, 4)->nullable();
            $table->decimal('kd_23', 19, 4)->nullable();
            $table->decimal('kd_24', 19, 4)->nullable();
            $table->decimal('kd_01', 19, 4)->nullable();
            $table->decimal('kd_02', 19, 4)->nullable();
            $table->decimal('kd_03', 19, 4)->nullable();
            $table->decimal('kd_04', 19, 4)->nullable();
            $table->decimal('kd_05', 19, 4)->nullable();
            $table->decimal('kd_06', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt_monitor_det');
    }
};
