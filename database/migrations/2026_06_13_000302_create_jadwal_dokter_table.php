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
        if (Schema::hasTable('jadwal_dokter')) {
            return;
        }

        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->integer('kode_jadwal')->nullable();
            $table->string('jadwal_dokter', 500)->nullable();
            $table->string('jam_praktek', 500)->nullable();
            $table->string('mulai', 500)->nullable();
            $table->string('periksa', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
