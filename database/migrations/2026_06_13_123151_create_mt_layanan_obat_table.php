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
        Schema::create('mt_layanan_obat', function (Blueprint $table) {
            $table->string('kode_layanan', 10);
            $table->string('nama_layanan', 50)->nullable();

            $table->primary(['kode_layanan'], 'pk_mt_layanan_obat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_layanan_obat');
    }
};
