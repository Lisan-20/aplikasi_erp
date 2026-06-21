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
        if (Schema::hasTable('acc_bedah')) {
            return;
        }

        Schema::create('acc_bedah', function (Blueprint $table) {
            $table->string('acc_bedah', 10);
            $table->string('nama_bedah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acc_bedah');
    }
};
