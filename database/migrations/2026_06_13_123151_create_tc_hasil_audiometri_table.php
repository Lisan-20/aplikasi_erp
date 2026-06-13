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
        Schema::create('tc_hasil_audiometri', function (Blueprint $table) {
            $table->bigIncrements('id_audiometri');
            $table->string('no_registrasi', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('kode_rm')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('kesimpulan', 250)->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->integer('nomor_urut')->nullable();
            $table->char('ext', 10)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->integer('user_delete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hasil_audiometri');
    }
};
