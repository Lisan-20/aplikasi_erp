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
        Schema::create('mt_golongan_umur', function (Blueprint $table) {
            $table->integer('kode_umur');
            $table->string('golongan_umur', 50)->nullable();
            $table->decimal('umur_awal', 18)->nullable();
            $table->decimal('umur_akhir', 18)->nullable();

            $table->primary(['kode_umur'], 'pk_mt_golongan_umur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_golongan_umur');
    }
};
