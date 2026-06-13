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
        Schema::create('pm_mt_bpako', function (Blueprint $table) {
            $table->integer('id_pm_mt_bpako');
            $table->integer('kode_tarif')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->integer('volume')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_bpako');
    }
};
