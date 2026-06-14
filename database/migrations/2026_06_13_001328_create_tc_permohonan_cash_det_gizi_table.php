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
        if (Schema::hasTable('tc_permohonan_cash_det_gizi')) {
            return;
        }

        Schema::create('tc_permohonan_cash_det_gizi', function (Blueprint $table) {
            $table->increments('id_tc_permohonan_det');
            $table->integer('id_tc_permohonan');
            $table->string('kode_brg', 18)->nullable();
            $table->integer('jumlah_besar_old')->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->integer('rasio')->nullable();
            $table->integer('status_po')->nullable();
            $table->integer('jumlah_besar_acc_old')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('flag_satuan')->nullable();
            $table->integer('ref')->nullable();
            $table->integer('minggu_po')->nullable();
            $table->integer('pilih_satuan')->nullable();
            $table->string('satuan', 20)->nullable();
            $table->decimal('harga_satuan_netto', 18)->nullable();
            $table->integer('flag_permohonan')->nullable();
            $table->decimal('jumlah_besar', 18)->nullable();
            $table->decimal('jumlah_besar_acc', 18)->nullable();
            $table->decimal('jml_harga_beli', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permohonan_cash_det_gizi');
    }
};
