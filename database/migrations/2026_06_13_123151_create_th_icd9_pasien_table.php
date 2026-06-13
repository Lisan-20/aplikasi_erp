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
        Schema::create('th_icd9_pasien', function (Blueprint $table) {
            $table->integer('kode_icd9_pasien');
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_icd9', 50)->nullable();
            $table->string('kode_asterik', 50)->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('group_depkes')->nullable()->default(0);
            $table->integer('no_registrasi')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->text('nama_icd9')->nullable();
            $table->text('tipe_rl')->nullable();
            $table->integer('status_itung')->nullable();
            $table->integer('umur')->nullable();
            $table->string('gender', 50)->nullable();
            $table->integer('status_hidup')->nullable();
            $table->integer('jns_penyakit')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('sys_lama')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_icd_pasien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_icd9_pasien');
    }
};
