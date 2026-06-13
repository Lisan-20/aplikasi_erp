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
        Schema::create('mt_menu_gizi', function (Blueprint $table) {
            $table->integer('id_menu')->nullable();
            $table->string('kode_menu', 50)->nullable();
            $table->string('kode_diet', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_menu_gizi');
    }
};
