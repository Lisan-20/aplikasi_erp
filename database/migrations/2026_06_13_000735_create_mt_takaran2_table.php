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
        if (Schema::hasTable('mt_takaran2')) {
            return;
        }

        Schema::create('mt_takaran2', function (Blueprint $table) {
            $table->integer('id_takaran')->nullable();
            $table->string('takaran', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_takaran2');
    }
};
