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
        if (Schema::hasTable('mt_pola_hd')) {
            return;
        }

        Schema::create('mt_pola_hd', function (Blueprint $table) {
            $table->increments('kd_pola_hd');
            $table->string('kode_tarif', 10)->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->decimal('pola_dr', 18)->nullable();
            $table->decimal('pola_rs', 18)->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('jenis_tindakan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pola_hd');
    }
};
