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
        if (Schema::hasTable('mt_icd_diagnosa_ri_gizi')) {
            return;
        }

        Schema::create('mt_icd_diagnosa_ri_gizi', function (Blueprint $table) {
            $table->string('nama_diagnosa')->nullable();
            $table->integer('kode_icd_diagnosa');
            $table->string('kode_icd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_icd_diagnosa_ri_gizi');
    }
};
