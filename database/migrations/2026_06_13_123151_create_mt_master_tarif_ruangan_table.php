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
        Schema::create('mt_master_tarif_ruangan', function (Blueprint $table) {
            $table->string('kd_tarif_r', 50);
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->decimal('harga_r', 15)->nullable();
            $table->integer('jumlah_k')->nullable();
            $table->integer('jumlah_tt')->nullable();
            $table->decimal('harga_r_l', 15)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->string('kode_tgl_tarif', 10)->nullable();
            $table->integer('kode_klas_det')->nullable();
            $table->decimal('harga_jkn', 15)->nullable();
            $table->string('kode_ruangan', 50)->nullable();
            $table->decimal('harga_pt_ass', 18)->nullable();
            $table->decimal('harga_inhealth', 18)->nullable();
            $table->decimal('harga_bpjs', 18)->nullable();
            $table->decimal('tarif_kamar_SC', 15)->nullable();
            $table->decimal('harga_bpjs_tk', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_ruangan');
    }
};
