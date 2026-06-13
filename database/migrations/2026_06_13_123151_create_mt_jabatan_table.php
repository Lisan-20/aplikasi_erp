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
        if (Schema::hasTable('mt_jabatan')) {
            return;
        }

        Schema::create('mt_jabatan', function (Blueprint $table) {
            $table->integer('kode_jabatan');
            $table->string('nama_jabatan', 50)->nullable();
            $table->tinyInteger('tingkatan')->nullable();
            $table->string('kode_lama', 10)->nullable();
            $table->integer('kd_st')->nullable();
            $table->integer('ref_jab')->nullable();
            $table->integer('lev_jab')->nullable();
            $table->integer('kode_kel_kerja')->nullable();

            $table->primary(['kode_jabatan'], 'pk_mt_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jabatan');
    }
};
