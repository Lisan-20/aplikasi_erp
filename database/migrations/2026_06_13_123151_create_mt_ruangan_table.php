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
        Schema::create('mt_ruangan', function (Blueprint $table) {
            $table->string('kode_ruangan', 100);
            $table->string('kode_bagian', 18);
            $table->integer('kode_klas')->nullable();
            $table->text('no_kamar')->nullable();
            $table->string('no_bed', 100)->nullable();
            $table->text('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('infeksi')->nullable();
            $table->integer('kode_klas_det')->nullable();
            $table->integer('kode_bag_depo')->nullable();
            $table->text('fasilitas')->nullable();
            $table->string('kode_klas_bpjs', 50)->nullable();
            $table->string('ket_dashboard', 50)->nullable();
            $table->integer('flag_aktif')->nullable();
            $table->integer('flag_umum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_ruangan');
    }
};
