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
        Schema::create('mt_saran', function (Blueprint $table) {
            $table->integer('id_mt_saran');
            $table->integer('id_mt_kesimpulan')->nullable();
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->string('saran')->nullable();
            $table->string('id_mt_fisik_det', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_saran');
    }
};
