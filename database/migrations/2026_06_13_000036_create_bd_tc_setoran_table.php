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
        if (Schema::hasTable('bd_tc_setoran')) {
            return;
        }

        Schema::create('bd_tc_setoran', function (Blueprint $table) {
            $table->integer('no_kuitansi_bendahara');
            $table->integer('no_induk_kasir');
            $table->integer('kode_loket');
            $table->integer('kode_shift');
            $table->dateTime('tgl_transaksi');
            $table->dateTime('tgl_disetor');
            $table->integer('no_induk');
            $table->decimal('tunai', 19, 4)->nullable();
            $table->decimal('debet', 19, 4)->nullable();
            $table->decimal('kredit', 19, 4)->nullable();
            $table->decimal('nd', 19, 4)->nullable();
            $table->decimal('nk_perusahaan', 19, 4)->nullable();
            $table->decimal('nk', 19, 4)->nullable();
            $table->decimal('selisih', 19, 4)->nullable();
            $table->string('ketarnagan')->nullable();
            $table->integer('id_bd_tc_trans')->nullable();

            $table->primary(['no_kuitansi_bendahara'], 'pk_bd_tc_setoran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_setoran');
    }
};
