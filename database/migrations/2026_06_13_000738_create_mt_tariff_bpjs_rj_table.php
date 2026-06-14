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
        if (Schema::hasTable('mt_tariff_bpjs_rj')) {
            return;
        }

        Schema::create('mt_tariff_bpjs_rj', function (Blueprint $table) {
            $table->integer('no');
            $table->string('ir_code', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('alos', 50)->nullable();
            $table->string('final_cost_weight', 50)->nullable();
            $table->string('base_rate', 50)->nullable();
            $table->string('poli_biasa', 50)->nullable();
            $table->decimal('kelas_2', 18, 5)->nullable();
            $table->decimal('poli_eksekutif', 18, 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tariff_bpjs_rj');
    }
};
