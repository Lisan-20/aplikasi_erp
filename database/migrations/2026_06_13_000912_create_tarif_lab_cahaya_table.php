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
        if (Schema::hasTable('tarif_lab_cahaya')) {
            return;
        }

        Schema::create('tarif_lab_cahaya', function (Blueprint $table) {
            $table->string('Tindakan')->nullable();
            $table->float('harga', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_lab_cahaya');
    }
};
