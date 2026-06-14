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
        if (Schema::hasTable('mt_karyawan_calon')) {
            return;
        }

        Schema::create('mt_karyawan_calon', function (Blueprint $table) {
            $table->increments('id_calon');
            $table->integer('urutan_karyawan')->nullable();
            $table->text('nama_pegawai')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('tmp_lahir', 50)->nullable();
            $table->string('tlp', 50)->nullable();
            $table->integer('id_sex')->nullable();
            $table->integer('id_status')->nullable();
            $table->integer('id_dc_kawin')->nullable();
            $table->integer('id_dc_agama')->nullable();
            $table->float('tinggi_Badan', null, 0)->nullable();
            $table->float('berat_badan', null, 0)->nullable();
            $table->string('gol_darah', 50)->nullable();
            $table->string('suku', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->text('nama_panggilan')->nullable();
            $table->string('no_ktp', 50)->nullable();
            $table->decimal('nominal_perfee', 19, 4)->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('tgl_berubah_status')->nullable();
            $table->integer('no_induk_calon')->nullable();
            $table->string('nilai_tes_msk', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->dateTime('tgl_tes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_karyawan_calon');
    }
};
