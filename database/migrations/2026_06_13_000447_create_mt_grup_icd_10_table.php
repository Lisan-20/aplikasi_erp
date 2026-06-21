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
        if (Schema::hasTable('mt_grup_icd_10')) {
            return;
        }

        Schema::create('mt_grup_icd_10', function (Blueprint $table) {
            $table->integer('id_grup_icd');
            $table->string('kode_icd', 10)->nullable();
            $table->string('nama_icd_10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_grup_icd_10');
    }
};
