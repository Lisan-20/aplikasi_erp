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
        if (Schema::hasTable('mt_gol_obat')) {
            return;
        }

        Schema::create('mt_gol_obat', function (Blueprint $table) {
            $table->string('kode', 2)->nullable();
            $table->string('gol_obat', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_gol_obat');
    }
};
