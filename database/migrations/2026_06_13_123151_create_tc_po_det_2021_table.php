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
        Schema::create('tc_po_det_2021', function (Blueprint $table) {
            $table->integer('id_tc_po_det');
            $table->integer('id_tc_po')->nullable();
            $table->integer('id_tc_permohonan_det')->nullable();
            $table->integer('id_tc_permohonan')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->integer('jumlah_besar')->nullable();
            $table->integer('content')->nullable();
            $table->decimal('harga_satuan', 18)->nullable();
            $table->decimal('harga_satuan_netto', 18)->nullable();
            $table->decimal('jumlah_harga', 18)->nullable();
            $table->decimal('jumlah_harga_netto', 18)->nullable();
            $table->decimal('discount', 18)->nullable();
            $table->integer('bonus_besar')->nullable();
            $table->integer('bonus_kecil')->nullable();
            $table->decimal('discount_rp', 18)->nullable();
            $table->decimal('discount_psn', 18)->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('status_close')->nullable();
            $table->decimal('ppn', 18, 0)->nullable();
            $table->integer('pilih_satuan')->nullable();
            $table->integer('user_batal')->nullable();
            $table->dateTime('tgl_batal')->nullable();
            $table->string('satuan', 50)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('jumlah_besar_acc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_po_det_2021');
    }
};
