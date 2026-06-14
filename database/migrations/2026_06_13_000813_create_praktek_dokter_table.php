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
        if (Schema::hasTable('praktek_dokter')) {
            return;
        }

        Schema::create('praktek_dokter', function (Blueprint $table) {
            $table->string('kode_praktek', 18);
            $table->string('hari', 50)->nullable();
            $table->string('kode_dokter', 3)->nullable();
            $table->dateTime('jam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praktek_dokter');
    }
};
