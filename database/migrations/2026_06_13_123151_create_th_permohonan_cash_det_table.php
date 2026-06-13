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
        Schema::create('th_permohonan_cash_det', function (Blueprint $table) {
            $table->increments('id_th_permohonan_det');
            $table->integer('id_th_permohonan')->nullable();
            $table->integer('id_tc_permohonan_det')->nullable();
            $table->integer('id_tc_permohonan');
            $table->string('kode_brg', 18)->nullable();
            $table->integer('jumlah_besar')->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->integer('rasio')->nullable();
            $table->integer('status_po')->nullable();
            $table->integer('jumlah_besar_acc')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('flag_satuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_permohonan_cash_det');
    }
};
