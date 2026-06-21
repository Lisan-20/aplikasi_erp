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
        if (Schema::hasTable('jenis_sppu')) {
            return;
        }

        Schema::create('jenis_sppu', function (Blueprint $table) {
            $table->integer('kode_jenis')->nullable();
            $table->string('nama_jenis', 50)->nullable();
            $table->string('inisial', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_sppu');
    }
};
