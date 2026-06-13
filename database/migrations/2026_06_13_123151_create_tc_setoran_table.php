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
        Schema::create('tc_setoran', function (Blueprint $table) {
            $table->integer('no_kuitansi_bendahara');
            $table->integer('no_induk_kasir');
            $table->integer('kode_loket');
            $table->integer('kode_shift');
            $table->dateTime('tgl_transaksi');
            $table->dateTime('tgl_disetor');
            $table->integer('no_induk');

            $table->primary(['no_kuitansi_bendahara'], 'pk_tc_setoran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_setoran');
    }
};
