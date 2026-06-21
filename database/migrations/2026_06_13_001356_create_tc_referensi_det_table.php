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
        if (Schema::hasTable('tc_referensi_det')) {
            return;
        }

        Schema::create('tc_referensi_det', function (Blueprint $table) {
            $table->increments('id_tc_ref_det');
            $table->integer('id_tc_ref');
            $table->string('kode_brg', 18)->nullable();
            $table->integer('jumlah_besar')->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->integer('rasio')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('pilih_satuan')->nullable();
            $table->string('satuan', 20)->nullable();
            $table->decimal('harga_satuan_netto', 18)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('satuan_besar_asli', 20)->nullable();
            $table->string('satuan_asli', 20)->nullable();
            $table->string('ref_kd_brg', 20)->nullable();
            $table->decimal('discount', 18)->nullable();
            $table->dateTime('tgl_ref')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_referensi_det');
    }
};
