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
        Schema::create('printto', function (Blueprint $table) {
            $table->integer('kd_printto');
            $table->string('nm_komputer_klien', 50)->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->integer('kd_printer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printto');
    }
};
