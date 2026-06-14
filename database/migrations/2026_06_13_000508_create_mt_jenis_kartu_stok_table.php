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
        if (Schema::hasTable('mt_jenis_kartu_stok')) {
            return;
        }

        Schema::create('mt_jenis_kartu_stok', function (Blueprint $table) {
            $table->integer('jenis_transaksi');
            $table->string('nama_jenis', 50)->nullable();

            $table->primary(['jenis_transaksi'], 'pk__mt_jenis_kartu_s__5c835c1e');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jenis_kartu_stok');
    }
};
