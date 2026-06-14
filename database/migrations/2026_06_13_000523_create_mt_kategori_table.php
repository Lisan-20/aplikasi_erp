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
        if (Schema::hasTable('mt_kategori')) {
            return;
        }

        Schema::create('mt_kategori', function (Blueprint $table) {
            $table->string('kode_kategori', 5);
            $table->string('nama_kategori')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kategori');
    }
};
