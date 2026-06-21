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
        if (Schema::hasTable('mt_speciment_1sehat')) {
            return;
        }

        Schema::create('mt_speciment_1sehat', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('code', 50)->nullable();
            $table->string('speciment', 350)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_speciment_1sehat');
    }
};
