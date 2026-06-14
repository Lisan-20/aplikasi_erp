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
        if (Schema::hasTable('tarif_detail')) {
            return;
        }

        Schema::create('tarif_detail', function (Blueprint $table) {
            $table->string('kode', 10)->nullable();
            $table->string('kelas', 10)->nullable();
            $table->decimal('jasa_rs', 18)->nullable();
            $table->decimal('jasa_dr', 18)->nullable();
            $table->decimal('pihak_1', 18)->nullable();
            $table->decimal('pihak_2', 18)->nullable();
            $table->decimal('alkes', 18)->nullable();
            $table->decimal('bp', 18)->nullable();
            $table->decimal('harga', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_detail');
    }
};
