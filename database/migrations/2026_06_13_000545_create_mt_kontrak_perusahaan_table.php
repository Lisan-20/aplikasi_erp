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
        if (Schema::hasTable('mt_kontrak_perusahaan')) {
            return;
        }

        Schema::create('mt_kontrak_perusahaan', function (Blueprint $table) {
            $table->increments('id_mt_kontrak_perusahaan');
            $table->integer('kode_perusahaan')->nullable();
            $table->string('no_kontrak', 20)->nullable();
            $table->dateTime('tgl_awal')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->integer('marketing')->nullable();
            $table->string('pejabat')->nullable();
            $table->integer('id_pejabat')->nullable();
            $table->string('wakil_perusahaan')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kontrak_perusahaan');
    }
};
