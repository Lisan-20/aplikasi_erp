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
        if (Schema::hasTable('th_task_bpjs')) {
            return;
        }

        Schema::create('th_task_bpjs', function (Blueprint $table) {
            $table->increments('id_th_task');
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_booking', 50)->nullable();
            $table->integer('task_id')->nullable();
            $table->dateTime('waktu_tgl')->nullable();
            $table->bigInteger('waktu')->nullable();
            $table->text('response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_task_bpjs');
    }
};
