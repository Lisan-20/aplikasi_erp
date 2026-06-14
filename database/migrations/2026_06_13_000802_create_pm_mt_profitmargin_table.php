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
        if (Schema::hasTable('pm_mt_profitmargin')) {
            return;
        }

        Schema::create('pm_mt_profitmargin', function (Blueprint $table) {
            $table->integer('id_pm_mt_profitmargin');
            $table->integer('kode_profit')->nullable();
            $table->string('nama_pelayanan', 20)->nullable();
            $table->integer('tingkat')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('profit_obat')->nullable();
            $table->integer('profit_alkes')->nullable();
            $table->integer('referensi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_profitmargin');
    }
};
