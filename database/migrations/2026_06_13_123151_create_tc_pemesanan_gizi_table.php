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
        Schema::create('tc_pemesanan_gizi', function (Blueprint $table) {
            $table->bigInteger('id_tc_pemesanan');
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('id_tc_sensus_gizi')->nullable();
            $table->dateTime('tgl_pesan')->nullable();
            $table->integer('status')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->char('no_pesan', 10)->nullable();
            $table->integer('user_pesan')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_kirim')->nullable();
            $table->integer('status_selesai')->nullable();
            $table->string('kode_menu', 20)->nullable();
            $table->string('distribusi', 50)->nullable();

            $table->primary(['id_tc_pemesanan'], 'pk_tc_pemesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemesanan_gizi');
    }
};
