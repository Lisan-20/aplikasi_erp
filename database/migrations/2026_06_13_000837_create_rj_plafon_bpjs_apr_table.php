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
        if (Schema::hasTable('rj_plafon_bpjs_apr')) {
            return;
        }

        Schema::create('rj_plafon_bpjs_apr', function (Blueprint $table) {
            $table->float('No#', 53, 0)->nullable();
            $table->string('Tgl# Masuk')->nullable();
            $table->string('Tgl# Pulang')->nullable();
            $table->string('No# RM')->nullable();
            $table->string('Nama Pasien')->nullable();
            $table->string('No# SEP')->nullable();
            $table->string('INACBG')->nullable();
            $table->string('Top Up')->nullable();
            $table->float('Total Tarif', 53, 0)->nullable();
            $table->float('Tarif RS', 53, 0)->nullable();
            $table->string('Jenis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rj_plafon_bpjs_apr');
    }
};
