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
        Schema::create('mt_master_icd10_asterik', function (Blueprint $table) {
            $table->increments('id_asterik');
            $table->string('kode_master_icd', 50)->nullable();
            $table->string('kode_asterik_icd', 50)->nullable();

            $table->primary(['id_asterik'], 'pk_mt_master_icd10_asterik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_icd10_asterik');
    }
};
