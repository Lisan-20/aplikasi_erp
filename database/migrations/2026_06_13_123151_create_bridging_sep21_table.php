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
        Schema::create('bridging_sep21', function (Blueprint $table) {
            $table->string('method', 50)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('param', 50)->nullable();
            $table->string('data', 150)->nullable();
            $table->integer('cari')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridging_sep21');
    }
};
