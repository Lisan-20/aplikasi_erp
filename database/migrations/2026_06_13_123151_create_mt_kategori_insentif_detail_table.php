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
        if (Schema::hasTable('mt_kategori_insentif_detail')) {
            return;
        }

        Schema::create('mt_kategori_insentif_detail', function (Blueprint $table) {
            $table->increments('id_mt_kategori_insentif_det');
            $table->integer('kode_kategori')->nullable();
            $table->integer('kode_kategori_detail')->nullable();
            $table->string('nama_kategori_detail')->nullable();
            $table->decimal('plafon', 19, 4)->nullable();
            $table->decimal('persen', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kategori_insentif_detail');
    }
};
