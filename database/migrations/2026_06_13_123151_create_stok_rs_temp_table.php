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
        Schema::create('stok_rs_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_brg', 50)->nullable();
            $table->string('nama_brg', 100)->nullable();
            $table->decimal('stok', 18)->nullable();
            $table->string('bagian', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_rs_temp');
    }
};
