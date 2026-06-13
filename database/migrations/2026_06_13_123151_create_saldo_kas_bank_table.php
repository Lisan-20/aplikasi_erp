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
        Schema::create('saldo_kas_bank', function (Blueprint $table) {
            $table->integer('id_bank')->nullable();
            $table->integer('Kas_Bank')->nullable();
            $table->string('acc_nama', 100)->nullable();
            $table->string('acc_no', 7)->nullable();
            $table->integer('urutan')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('bulan')->nullable();
            $table->decimal('saldo_awal', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_kas_bank');
    }
};
