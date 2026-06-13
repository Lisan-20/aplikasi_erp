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
        Schema::create('mt_pola_diskon_tarif', function (Blueprint $table) {
            $table->integer('kd_pola_diskon_tarif');
            $table->string('kode_perusahaan')->nullable();
            $table->decimal('diskon', 18)->nullable();
            $table->decimal('diskon_dr_part', 18)->nullable();
            $table->decimal('diskon_dr_full', 18)->nullable();
            $table->integer('diskon_rs')->nullable();
            $table->integer('diskon_dr1')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('kd_jenis_diskon')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_jenis_tindakan')->nullable();
            $table->string('kode_tarif', 20)->nullable();
            $table->integer('kd_pola_diskon')->nullable();
            $table->integer('flag_rp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pola_diskon_tarif');
    }
};
