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
        Schema::create('mt_tim_kredensialing', function (Blueprint $table) {
            $table->increments('id_tim');
            $table->integer('npp1')->nullable();
            $table->char('Jab_tim', 10)->nullable();
            $table->integer('st_aktif')->nullable();
            $table->string('npp', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tim_kredensialing');
    }
};
