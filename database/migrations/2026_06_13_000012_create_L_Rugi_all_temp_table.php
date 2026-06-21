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
        if (Schema::hasTable('L_Rugi_all_temp')) {
            return;
        }

        Schema::create('L_Rugi_all_temp', function (Blueprint $table) {
            $table->integer('acc_no')->nullable();
            $table->decimal('debet', 18)->nullable();
            $table->decimal('kredit', 18)->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('tx_tipe', 1)->nullable();
            $table->integer('referensi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('L_Rugi_all_temp');
    }
};
