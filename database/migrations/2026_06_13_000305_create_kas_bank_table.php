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
        if (Schema::hasTable('kas_bank')) {
            return;
        }

        Schema::create('kas_bank', function (Blueprint $table) {
            $table->integer('Id_Kas_Bank')->nullable();
            $table->string('Kas_Bank', 10)->nullable();
            $table->string('acc_no', 50)->nullable();
            $table->integer('urutan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_bank');
    }
};
