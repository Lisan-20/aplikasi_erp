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
        if (Schema::hasTable('refppkbaru')) {
            return;
        }

        Schema::create('refppkbaru', function (Blueprint $table) {
            $table->float('ID', 53, 0)->nullable();
            $table->float('KDPPK', 53, 0)->nullable();
            $table->string('NMPPK')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refppkbaru');
    }
};
