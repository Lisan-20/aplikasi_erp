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
        if (Schema::hasTable('mt_hcp')) {
            return;
        }

        Schema::create('mt_hcp', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('description', 50)->nullable();
            $table->decimal('benefit', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_hcp');
    }
};
