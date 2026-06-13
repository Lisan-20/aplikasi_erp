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
        Schema::create('mt_ambulance', function (Blueprint $table) {
            $table->integer('kode_mt_ambul')->nullable();
            $table->string('tujuan')->nullable();
            $table->decimal('harga', 18, 0)->nullable();
            $table->integer('referensi')->nullable();
            $table->decimal('uang_jalan', 18, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_ambulance');
    }
};
