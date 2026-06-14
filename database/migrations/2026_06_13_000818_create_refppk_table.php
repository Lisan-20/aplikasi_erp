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
        if (Schema::hasTable('refppk')) {
            return;
        }

        Schema::create('refppk', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('KDPPK')->nullable();
            $table->text('NMPPK')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refppk');
    }
};
