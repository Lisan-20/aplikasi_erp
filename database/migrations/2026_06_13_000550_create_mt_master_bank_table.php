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
        if (Schema::hasTable('mt_master_bank')) {
            return;
        }

        Schema::create('mt_master_bank', function (Blueprint $table) {
            $table->increments('id_bank');
            $table->string('nama_bank', 50)->nullable();
            $table->string('no_rekening', 50)->nullable();
            $table->string('nama_nasabah', 100)->nullable();
            $table->string('cabang', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_bank');
    }
};
