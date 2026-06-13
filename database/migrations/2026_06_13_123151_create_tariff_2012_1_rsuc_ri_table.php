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
        Schema::create('tariff_2012_1_rsuc_ri', function (Blueprint $table) {
            $table->integer('no');
            $table->string('ir_code', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('alos', 50)->nullable();
            $table->string('final_cost_weight', 50)->nullable();
            $table->string('base_rate', 50)->nullable();
            $table->decimal('kelas_3', 18, 5)->nullable();
            $table->decimal('kelas_2', 18, 5)->nullable();
            $table->decimal('kelas_1', 18, 5)->nullable();
            $table->decimal('vip', 18, 5)->nullable();
            $table->decimal('vvip', 18, 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariff_2012_1_rsuc_ri');
    }
};
