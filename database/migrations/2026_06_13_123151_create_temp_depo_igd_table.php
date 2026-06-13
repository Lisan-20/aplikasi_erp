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
        Schema::create('temp_depo_igd', function (Blueprint $table) {
            $table->integer('kd')->nullable();
            $table->text('nama_barang')->nullable();
            $table->char('kd_barang', 10)->nullable();
            $table->char('kd_bagian', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_depo_igd');
    }
};
