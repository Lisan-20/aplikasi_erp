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
        if (Schema::hasTable('mt_paket_askes')) {
            return;
        }

        Schema::create('mt_paket_askes', function (Blueprint $table) {
            $table->increments('id_mt_paket_askes');
            $table->integer('kode_paket_askes');
            $table->string('nama_paket_askes', 100)->nullable();
            $table->string('kelompok', 50)->nullable();
            $table->string('ket', 50)->nullable();

            $table->primary(['kode_paket_askes'], 'pk_mt_paket_askes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_paket_askes');
    }
};
