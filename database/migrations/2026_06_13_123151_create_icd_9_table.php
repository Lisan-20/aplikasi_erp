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
        Schema::create('icd_9', function (Blueprint $table) {
            $table->string('code_procedure')->nullable();
            $table->string('ket_lengkap')->nullable();
            $table->string('ket_pendek')->nullable();
            $table->string('F4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icd_9');
    }
};
