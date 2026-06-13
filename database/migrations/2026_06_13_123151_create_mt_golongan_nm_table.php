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
        Schema::create('mt_golongan_nm', function (Blueprint $table) {
            $table->string('kode_golongan', 3);
            $table->string('nama_golongan', 50)->nullable();
            $table->integer('kode_mapp')->nullable();

            $table->primary(['kode_golongan'], 'pk_mt_golongan_nm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_golongan_nm');
    }
};
