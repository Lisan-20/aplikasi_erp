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
        if (Schema::hasTable('tarifhard')) {
            return;
        }

        Schema::create('tarifhard', function (Blueprint $table) {
            $table->float('KODE', 53, 0)->nullable();
            $table->string('NAMA')->nullable();
            $table->float('3', 53, 0)->nullable();
            $table->float('2', 53, 0)->nullable();
            $table->float('1', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifhard');
    }
};
