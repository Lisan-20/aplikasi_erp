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
        Schema::create('tc_riwayat_status', function (Blueprint $table) {
            $table->increments('id_stat');
            $table->dateTime('tgl_upd')->nullable();
            $table->integer('user_upd')->nullable();
            $table->string('no_mr', 6)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('status')->nullable();
            $table->string('kode_bagian_kirim', 6)->nullable();
            $table->string('kode_bagian_terima', 6)->nullable();
            $table->dateTime('tgl_terima')->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->string('user_terima', 50)->nullable();
            $table->string('user_kirim', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_riwayat_status');
    }
};
