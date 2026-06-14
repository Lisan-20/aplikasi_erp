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
        if (Schema::hasTable('mt_paket_poliklinik')) {
            return;
        }

        Schema::create('mt_paket_poliklinik', function (Blueprint $table) {
            $table->increments('kode_paket');
            $table->integer('kode_tarif')->nullable();
            $table->string('kode_bagian', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_paket_poliklinik');
    }
};
