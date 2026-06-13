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
        Schema::create('tc_pemeriksaan_cairan', function (Blueprint $table) {
            $table->increments('no_imbang');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable()->index('ix_no_registrasi');
            $table->string('no_kunjungan', 50)->nullable()->index('ix_no_kunjungan');
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('shift')->nullable();
            $table->decimal('jml_masuk', 19, 4)->nullable();
            $table->decimal('jml_keluar', 19, 4)->nullable();
            $table->decimal('jml_keseimbangan', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaan_cairan');
    }
};
