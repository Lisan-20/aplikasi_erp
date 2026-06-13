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
        Schema::create('fr_mt_profit_margin_persh', function (Blueprint $table) {
            $table->integer('id_profit_perusahaan');
            $table->integer('kode_kelompok')->nullable();
            $table->string('kode_perusahaan', 20)->nullable();
            $table->decimal('profit_obat', 10)->nullable();
            $table->decimal('profit_alkes', 10)->nullable();
            $table->decimal('diskon_obat', 10)->nullable();
            $table->decimal('diskon_kamar', 10)->nullable();

            $table->primary(['id_profit_perusahaan'], 'pk_fr_mt_profit_margin_persh_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_mt_profit_margin_persh');
    }
};
