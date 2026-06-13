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
        Schema::create('mt_teminology_lab_1sehat', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('code', 50)->nullable();
            $table->text('display')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_teminology_lab_1sehat');
    }
};
