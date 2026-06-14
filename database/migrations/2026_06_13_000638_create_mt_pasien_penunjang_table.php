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
        if (Schema::hasTable('mt_pasien_penunjang')) {
            return;
        }

        Schema::create('mt_pasien_penunjang', function (Blueprint $table) {
            $table->integer('id_mt_pasien_penunjang');
            $table->string('no_pm', 8)->nullable();
            $table->integer('no_urutan')->nullable();
            $table->integer('kode_penunjang')->nullable();
            $table->string('nama_pasien', 50)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->string('alamat_pasien', 50)->nullable();
            $table->string('jen_kelamin', 10)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('flag_pm')->nullable();
            $table->string('dokter_pengirim', 50)->nullable();
            $table->string('no_tlp', 50)->nullable();

            $table->primary(['id_mt_pasien_penunjang'], 'pk_mt_pasien_penunjang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pasien_penunjang');
    }
};
