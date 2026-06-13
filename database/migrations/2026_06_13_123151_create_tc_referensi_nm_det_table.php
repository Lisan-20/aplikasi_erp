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
        Schema::create('tc_referensi_nm_det', function (Blueprint $table) {
            $table->integer('id_tc_ref_det');
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
            $table->dateTime('tgl_ref')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_referensi_nm_det');
    }
};
