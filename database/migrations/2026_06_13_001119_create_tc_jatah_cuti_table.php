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
        if (Schema::hasTable('tc_jatah_cuti')) {
            return;
        }

        Schema::create('tc_jatah_cuti', function (Blueprint $table) {
            $table->increments('id_tc_jatah_cuti');
            $table->text('npp')->nullable();
            $table->integer('jatah_cuti')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('id_dd_jenis_cuti')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('ko_wil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_jatah_cuti');
    }
};
