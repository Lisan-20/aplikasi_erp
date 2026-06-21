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
        if (Schema::hasTable('tc_antrian_loket_old')) {
            return;
        }

        Schema::create('tc_antrian_loket_old', function (Blueprint $table) {
            $table->integer('no_urut');
            $table->integer('loket');
            $table->dateTime('tgl_antrian');
            $table->string('kode_layanan', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('panggil')->nullable();
            $table->string('no_antrian', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_antrian_loket_old');
    }
};
