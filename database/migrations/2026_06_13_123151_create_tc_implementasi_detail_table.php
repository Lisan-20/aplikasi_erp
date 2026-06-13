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
        Schema::create('tc_implementasi_detail', function (Blueprint $table) {
            $table->increments('id_imp_det');
            $table->integer('id_imp')->nullable();
            $table->string('kode_pemeriksaan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_implementasi_detail');
    }
};
