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
        Schema::create('mt_pola_dokter', function (Blueprint $table) {
            $table->string('acc_pola_dokter', 5);
            $table->string('nama_pola_dokter', 50)->nullable();
            $table->string('status_dr', 50)->nullable();
            $table->decimal('rs', 15)->nullable();
            $table->decimal('pajak', 15)->nullable();
            $table->string('acc_pola', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pola_dokter');
    }
};
