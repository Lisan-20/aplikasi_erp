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
        if (Schema::hasTable('bd_tc_proses_gaji')) {
            return;
        }

        Schema::create('bd_tc_proses_gaji', function (Blueprint $table) {
            $table->increments('id_bd_tc_proses_gaji');
            $table->integer('id_periode_gaji')->nullable();
            $table->dateTime('tgl_pembentukan')->nullable();
            $table->string('no_bukti', 50)->nullable();
            $table->decimal('jumlah', 18, 0)->nullable();
            $table->integer('status_bayar')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->date('tgl_bayar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_proses_gaji');
    }
};
