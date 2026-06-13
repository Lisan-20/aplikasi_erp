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
        if (Schema::hasTable('mt_prik_gigi')) {
            return;
        }

        Schema::create('mt_prik_gigi', function (Blueprint $table) {
            $table->integer('no_prik_gigi');
            $table->string('prik_gigi', 60)->nullable();
            $table->string('warna', 50)->nullable();
            $table->string('kode_grup_tindakan', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_prik_gigi');
    }
};
