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
        Schema::create('pm_mt_standarhasil_lab_det', function (Blueprint $table) {
            $table->integer('kode_mt_hasilpm_detx');
            $table->bigInteger('kode_mt_hasilpm')->nullable();
            $table->text('ket_hasil')->nullable();
            $table->integer('val_hasil')->nullable();
            $table->string('nilai_hasil', 50)->nullable();
            $table->increments('kode_mt_hasilpm_det');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_standarhasil_lab_det');
    }
};
