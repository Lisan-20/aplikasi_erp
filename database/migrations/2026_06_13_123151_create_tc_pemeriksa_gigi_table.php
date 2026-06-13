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
        Schema::create('tc_pemeriksa_gigi', function (Blueprint $table) {
            $table->increments('id_tc_gigi');
            $table->string('no_mr')->nullable();
            $table->string('no_registrasi')->nullable();
            $table->integer('no_gigi')->nullable();
            $table->integer('id_per')->nullable();
            $table->integer('id_keadaan')->nullable();
            $table->integer('id_bahan')->nullable();
            $table->integer('id_restorasi')->nullable();
            $table->integer('id_protesa')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tlg_input')->nullable();
            $table->text('txt_lain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksa_gigi');
    }
};
