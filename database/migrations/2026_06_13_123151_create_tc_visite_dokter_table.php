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
        if (Schema::hasTable('tc_visite_dokter')) {
            return;
        }

        Schema::create('tc_visite_dokter', function (Blueprint $table) {
            $table->increments('no_urut_visit');
            $table->dateTime('tgl_jam')->nullable();
            $table->integer('kode_shift')->nullable();
            $table->integer('no_induk_per')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_visite_dokter');
    }
};
