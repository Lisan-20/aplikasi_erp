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
        if (Schema::hasTable('tariff_inacbg')) {
            return;
        }

        Schema::create('tariff_inacbg', function (Blueprint $table) {
            $table->increments('no');
            $table->string('inacbg', 50)->nullable();
            $table->string('regional', 50)->nullable();
            $table->string('kode_tariff', 50)->nullable();
            $table->integer('kelas_rawat')->nullable();
            $table->integer('jenis_pelayanan')->nullable();
            $table->decimal('tariff_original', 18)->nullable();
            $table->decimal('tariff', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariff_inacbg');
    }
};
