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
        if (Schema::hasTable('bd_mt_saldo_awal')) {
            return;
        }

        Schema::create('bd_mt_saldo_awal', function (Blueprint $table) {
            $table->increments('id_bd_mt_saldo_awal');
            $table->integer('id_dd_bank');
            $table->string('nama_saldo', 50);
            $table->string('keterangan', 250)->nullable();
            $table->decimal('nominal', 19, 4);
            $table->integer('input_id');
            $table->dateTime('input_tgl');
            $table->integer('edit_id')->nullable();
            $table->dateTime('edit_tgl')->nullable();

            $table->primary(['id_bd_mt_saldo_awal'], 'pk_bd_mt_saldo_awal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_mt_saldo_awal');
    }
};
