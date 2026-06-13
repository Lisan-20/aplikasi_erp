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
        Schema::create('mt_ruangan_kosong', function (Blueprint $table) {
            $table->string('kode_ruangan', 6);
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('no_kamar', 3)->nullable();
            $table->string('no_bed', 3)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('keterangan', 20)->nullable();
            $table->string('infeksi', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_ruangan_kosong');
    }
};
