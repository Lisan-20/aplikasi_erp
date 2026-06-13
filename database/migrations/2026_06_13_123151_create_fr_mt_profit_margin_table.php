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
        Schema::create('fr_mt_profit_margin', function (Blueprint $table) {
            $table->integer('id_profit');
            $table->integer('kode_profit')->nullable();
            $table->string('nama_pelayanan', 20)->nullable();
            $table->integer('tingkat')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->decimal('profit_obat', 19, 4)->nullable();
            $table->decimal('profit_alkes', 19, 4)->nullable();
            $table->integer('referensi')->nullable();
            $table->integer('golongan')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->decimal('profit_umum', 19, 4)->nullable();
            $table->decimal('profit_pajak', 19, 4)->nullable();

            $table->primary(['id_profit'], 'pk_fr_mt_profit_margin_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_mt_profit_margin');
    }
};
