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
        Schema::create('mt_GF_dr', function (Blueprint $table) {
            $table->integer('id_gf_dr')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('kondisi', 100)->nullable();
            $table->string('keterangan', 150)->nullable();
            $table->integer('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_GF_dr');
    }
};
