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
        if (Schema::hasTable('tc_produksi_obat_det')) {
            return;
        }

        Schema::create('tc_produksi_obat_det', function (Blueprint $table) {
            $table->increments('id_tc_produksi_det');
            $table->integer('id_tc_produksi');
            $table->string('kode_brg', 18)->nullable();
            $table->integer('jumlah_besar')->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->integer('rasio')->nullable();
            $table->integer('status_po')->nullable();
            $table->integer('jumlah_besar_acc')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_produksi_obat_det');
    }
};
