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
        if (Schema::hasTable('acc_operasi_ket')) {
            return;
        }

        Schema::create('acc_operasi_ket', function (Blueprint $table) {
            $table->integer('acc_operasi_ket');
            $table->string('nama_ket_operasi')->nullable();
            $table->string('acc_operasi', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acc_operasi_ket');
    }
};
