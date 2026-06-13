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
        Schema::create('tariff_cbg', function (Blueprint $table) {
            $table->string('inacbg')->nullable();
            $table->string('regional')->nullable();
            $table->string('kode_tariff')->nullable();
            $table->float('kelas_rawat', 53, 0)->nullable();
            $table->float(' jenis_pelayanan', 53, 0)->nullable();
            $table->float('tariff_original', 53, 0)->nullable();
            $table->float(' tariff', 53, 0)->nullable();
            $table->string('inp', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariff_cbg');
    }
};
