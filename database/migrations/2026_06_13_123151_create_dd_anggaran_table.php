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
        Schema::create('dd_anggaran', function (Blueprint $table) {
            $table->increments('id_dd_anggaran');
            $table->integer('acc_no')->nullable();
            $table->integer('id_dc_modul')->nullable();
            $table->string('jenis_anggaran', 50)->nullable();
            $table->integer('status_jenis_ang')->nullable();
            $table->dateTime('tgl_jenis_ang')->nullable();
            $table->integer('kowil')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();

            $table->primary(['id_dd_anggaran'], 'pk_dd_anggaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_anggaran');
    }
};
