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
        Schema::create('mt_brg_update', function (Blueprint $table) {
            $table->float('NO', 53, 0)->nullable();
            $table->string('NAMA OBAT')->nullable();
            $table->string('SATUAN BESAR')->nullable();
            $table->string('SATUAN KECIL')->nullable();
            $table->float('CONTENT/ISI', 53, 0)->nullable();
            $table->float('HARGA SATUAN BESAR', 53, 0)->nullable();
            $table->float('HARGA SATUAN KECIL', 53, 0)->nullable();
            $table->string('KANDUNGAN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_brg_update');
    }
};
