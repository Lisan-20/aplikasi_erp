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
        Schema::create('tc_permintaan_instalasi', function (Blueprint $table) {
            $table->string('nomor_permintaan', 18);
            $table->dateTime('tgl_permintaan')->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->integer('gudang')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('nomor_permintaan_tahun')->nullable();

            $table->primary(['nomor_permintaan'], 'pk__tc_permintaan_in__5e80b329');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permintaan_instalasi');
    }
};
