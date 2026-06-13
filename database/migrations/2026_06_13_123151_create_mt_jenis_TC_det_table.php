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
        Schema::create('mt_jenis_TC_det', function (Blueprint $table) {
            $table->increments('nomer_tind');
            $table->text('nama_tindakan')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->integer('kode_bagian')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->decimal('harga_satuan', 19, 4)->nullable();
            $table->integer('jumlah_hari')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_TC_det');
    }
};
