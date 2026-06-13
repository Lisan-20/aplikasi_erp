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
        if (Schema::hasTable('mt_pola_diskon')) {
            return;
        }

        Schema::create('mt_pola_diskon', function (Blueprint $table) {
            $table->integer('kd_pola_diskon');
            $table->string('kode_perusahaan')->nullable();
            $table->decimal('diskon', 18)->nullable();
            $table->decimal('diskon_dr_part', 18)->nullable();
            $table->decimal('diskon_dr_full', 18)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('kd_jenis_diskon')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_jenis_tindakan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pola_diskon');
    }
};
