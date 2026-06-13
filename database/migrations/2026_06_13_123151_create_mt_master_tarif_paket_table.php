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
        Schema::create('mt_master_tarif_paket', function (Blueprint $table) {
            $table->increments('id_paket_sc');
            $table->string('nama_paket', 50)->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
            $table->integer('status_paket')->nullable();
            $table->string('kode_rs', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_paket');
    }
};
