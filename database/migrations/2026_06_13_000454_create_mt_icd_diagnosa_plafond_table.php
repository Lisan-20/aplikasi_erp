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
        if (Schema::hasTable('mt_icd_diagnosa_plafond')) {
            return;
        }

        Schema::create('mt_icd_diagnosa_plafond', function (Blueprint $table) {
            $table->increments('id_mt_icd_diagnosa_det');
            $table->integer('id_mt_icd_diagnosa')->nullable();
            $table->integer('klas')->nullable();
            $table->decimal('plafond_awal', 18, 0)->nullable();
            $table->string('ket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_icd_diagnosa_plafond');
    }
};
