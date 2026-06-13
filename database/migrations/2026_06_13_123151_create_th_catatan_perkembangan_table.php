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
        Schema::create('th_catatan_perkembangan', function (Blueprint $table) {
            $table->increments('id_cttn_perkembangan');
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('shift', 5)->nullable();
            $table->text('catatan')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_catatan_perkembangan');
    }
};
