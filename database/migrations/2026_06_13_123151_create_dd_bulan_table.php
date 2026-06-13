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
        if (Schema::hasTable('dd_bulan')) {
            return;
        }

        Schema::create('dd_bulan', function (Blueprint $table) {
            $table->integer('id_bulan')->nullable();
            $table->string('nama_bulan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_bulan');
    }
};
