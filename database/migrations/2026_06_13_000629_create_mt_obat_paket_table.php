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
        if (Schema::hasTable('mt_obat_paket')) {
            return;
        }

        Schema::create('mt_obat_paket', function (Blueprint $table) {
            $table->increments('kode_paket');
            $table->string('kode_dokter', 10)->nullable();
            $table->string('nama_paket', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_obat_paket');
    }
};
