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
        if (Schema::hasTable('online')) {
            return;
        }

        Schema::create('online', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick', 100)->nullable();
            $table->dateTime('waktu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online');
    }
};
