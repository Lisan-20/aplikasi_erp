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
        Schema::create('tc_edukasi_terpadu', function (Blueprint $table) {
            $table->increments('no_urut_edukasi');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('ttd_nama', 250)->nullable();
            $table->text('ttd')->nullable();
            $table->dateTime('tgl_ttd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_edukasi_terpadu');
    }
};
