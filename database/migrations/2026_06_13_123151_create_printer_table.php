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
        if (Schema::hasTable('printer')) {
            return;
        }

        Schema::create('printer', function (Blueprint $table) {
            $table->integer('kd_printer');
            $table->string('nm_komputer', 50)->nullable();
            $table->string('nm_printer', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printer');
    }
};
