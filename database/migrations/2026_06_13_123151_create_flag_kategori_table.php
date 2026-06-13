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
        if (Schema::hasTable('flag_kategori')) {
            return;
        }

        Schema::create('flag_kategori', function (Blueprint $table) {
            $table->integer('kode')->nullable();
            $table->string('nama_kategori', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flag_kategori');
    }
};
