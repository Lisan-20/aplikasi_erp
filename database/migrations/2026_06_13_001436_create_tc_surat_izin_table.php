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
        if (Schema::hasTable('tc_surat_izin')) {
            return;
        }

        Schema::create('tc_surat_izin', function (Blueprint $table) {
            $table->integer('id_tc_surat_izin');
            $table->string('id_mt_surat_izin', 50)->nullable();
            $table->text('no_surat')->nullable();
            $table->dateTime('tgl_berlaku')->nullable();
            $table->dateTime('tgl_berakhir')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->bigInteger('npp')->nullable();
            $table->text('nama_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_surat_izin');
    }
};
