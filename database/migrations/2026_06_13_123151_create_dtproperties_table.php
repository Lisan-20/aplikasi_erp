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
        if (Schema::hasTable('dtproperties')) {
            return;
        }

        Schema::create('dtproperties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('objectid')->nullable();
            $table->string('property', 64);
            $table->string('value')->nullable();
            $table->string('uvalue')->nullable();
            $table->binary('lvalue')->nullable();
            $table->integer('version')->default(0);

            $table->primary(['id', 'property'], 'pk_dtproperties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtproperties');
    }
};
