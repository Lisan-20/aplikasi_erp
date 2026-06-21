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
        if (Schema::hasTable('tc_pemeriksaan_kredensial')) {
            return;
        }

        Schema::create('tc_pemeriksaan_kredensial', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kred')->nullable();
            $table->string('npp', 30)->nullable()->index('ix_npp');
            $table->integer('kd_periksa')->nullable()->index('ix_kd_periksa');
            $table->integer('hasil')->nullable();
            $table->integer('id_periksa')->nullable();
            $table->integer('id_kewenangan')->nullable()->index('ix_id_kewenangan');
            $table->dateTime('tgl_update')->nullable();
            $table->integer('hasil_tim')->nullable();
            $table->integer('hasil_rekomendasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaan_kredensial');
    }
};
