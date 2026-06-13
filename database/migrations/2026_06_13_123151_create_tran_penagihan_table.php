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
        Schema::create('tran_penagihan', function (Blueprint $table) {
            $table->bigIncrements('kode_tran_penagihan');
            $table->bigInteger('id_tc_tagih')->nullable();
            $table->string('no_bukti', 20)->nullable();
            $table->dateTime('tx_tgl')->nullable();
            $table->decimal('tx_nominal', 18, 0)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode')->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tran_penagihan');
    }
};
