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
        Schema::create('mt_master_tarif_ruangan_perusahaan', function (Blueprint $table) {
            $table->string('kd_tarif_r_persh', 50);
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->decimal('harga_r', 15)->nullable();
            $table->integer('jumlah_k')->nullable();
            $table->integer('jumlah_tt')->nullable();
            $table->decimal('harga_r_l', 15)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->string('kode_tgl_tarif', 10)->nullable();
            $table->integer('kode_perusahaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_ruangan_perusahaan');
    }
};
