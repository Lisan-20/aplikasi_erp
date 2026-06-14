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
        if (Schema::hasTable('mt_permukaan_gigi')) {
            return;
        }

        Schema::create('mt_permukaan_gigi', function (Blueprint $table) {
            $table->increments('id_per');
            $table->string('singkatan', 2)->nullable();
            $table->string('permukaan_gigi', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_permukaan_gigi');
    }
};
