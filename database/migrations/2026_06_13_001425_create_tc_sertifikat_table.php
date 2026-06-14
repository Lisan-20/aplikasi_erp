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
        if (Schema::hasTable('tc_sertifikat')) {
            return;
        }

        Schema::create('tc_sertifikat', function (Blueprint $table) {
            $table->increments('id_tc_sertifikat');
            $table->bigInteger('npp1')->nullable();
            $table->string('nama_kegiatan', 250)->nullable();
            $table->dateTime('tgl_kegiatan')->nullable();
            $table->string('lembaga', 100)->nullable();
            $table->string('no_piagam', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('id_int')->nullable();
            $table->dateTime('tgl_kegiatan2')->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->integer('id_pen')->nullable();
            $table->string('lokasi', 250)->nullable();
            $table->decimal('durasi', 18, 0)->nullable();
            $table->decimal('skp', 18, 0)->nullable();
            $table->decimal('komp_didapat', 18, 0)->nullable();
            $table->string('npp', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_sertifikat');
    }
};
