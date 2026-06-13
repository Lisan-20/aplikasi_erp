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
        if (Schema::hasTable('tbl_lap_rekam_medis')) {
            return;
        }

        Schema::create('tbl_lap_rekam_medis', function (Blueprint $table) {
            $table->increments('kode_lap_rm');
            $table->string('nama_kolom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lap_rekam_medis');
    }
};
