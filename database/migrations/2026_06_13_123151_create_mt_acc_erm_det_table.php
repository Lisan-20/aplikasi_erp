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
        Schema::create('mt_acc_erm_det', function (Blueprint $table) {
            $table->increments('id_mt_kd_det');
            $table->string('kd_periksa', 8)->nullable();
            $table->string('nama_pemeriksaan_det', 250)->nullable();
            $table->integer('value')->nullable();
            $table->text('anjuran')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->integer('skor_gizi')->nullable();
            $table->integer('skor_risiko')->nullable();
            $table->integer('skor_nyeri')->nullable();
            $table->integer('skor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_acc_erm_det');
    }
};
