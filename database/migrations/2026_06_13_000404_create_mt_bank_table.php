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
        if (Schema::hasTable('mt_bank')) {
            return;
        }

        Schema::create('mt_bank', function (Blueprint $table) {
            $table->integer('kode_bank');
            $table->string('nama_bank', 20)->nullable();
            $table->string('acc_no', 20)->nullable();
            $table->tinyInteger('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bank');
    }
};
