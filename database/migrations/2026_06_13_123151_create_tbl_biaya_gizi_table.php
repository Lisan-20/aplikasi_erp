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
        Schema::create('tbl_biaya_gizi', function (Blueprint $table) {
            $table->increments('id_biaya');
            $table->integer('id_gol')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->decimal('biaya_gizi', 19, 4)->nullable();
            $table->integer('kode_kelompok')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_biaya_gizi');
    }
};
