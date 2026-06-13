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
        Schema::create('GROUPER_INACBG_REST', function (Blueprint $table) {
            $table->increments('KodeMan');
            $table->string('NoSep', 50)->nullable();
            $table->string('NoPeserta', 50)->nullable();
            $table->string('NoMr', 50)->nullable();
            $table->dateTime('TglMasuk')->nullable();
            $table->dateTime('TglKeluar')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('JenisRawat')->nullable();
            $table->integer('KelasRawat')->nullable();
            $table->string('StayInd', 1)->nullable();
            $table->decimal('TotalTarif', 19, 4)->nullable();
            $table->decimal('Tarif', 19, 4)->nullable();
            $table->string('Inacbg', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GROUPER_INACBG_REST');
    }
};
