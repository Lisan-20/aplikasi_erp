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
        if (Schema::hasTable('tc_cppt_ventilator')) {
            return;
        }

        Schema::create('tc_cppt_ventilator', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->dateTime('tgl_jam_lepas')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->text('indikasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('pasang_lepas', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->integer('kode_dokter_ver')->nullable();
            $table->char('tgl_jam_ver', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt_ventilator');
    }
};
