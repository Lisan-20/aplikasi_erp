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
        if (Schema::hasTable('mt_jenis_obat')) {
            return;
        }

        Schema::create('mt_jenis_obat', function (Blueprint $table) {
            $table->integer('kode_jenis');
            $table->string('nama_jenis', 100)->nullable();

            $table->primary(['kode_jenis'], 'pk_mt_jenis_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_obat');
    }
};
