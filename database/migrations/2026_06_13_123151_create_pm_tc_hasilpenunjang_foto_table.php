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
        Schema::create('pm_tc_hasilpenunjang_foto', function (Blueprint $table) {
            $table->string('id', 50)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('foto', 50)->nullable();
            $table->dateTime('dibuat_pada')->nullable();
            $table->bigInteger('dibuat_oleh')->nullable();
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->integer('nomor')->nullable();
            $table->char('ext', 10)->nullable();
            $table->dateTime('dihapus_pada')->nullable();
            $table->bigInteger('dihapus_oleh')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('kode_penunjang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_tc_hasilpenunjang_foto');
    }
};
