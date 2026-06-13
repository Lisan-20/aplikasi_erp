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
        Schema::create('mt_kategori_nm', function (Blueprint $table) {
            $table->string('kode_kategori', 1);
            $table->string('nama_kategori')->nullable();

            $table->primary(['kode_kategori'], 'pk_mt_kategori_nm_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kategori_nm');
    }
};
