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
        if (Schema::hasTable('mt_jadwal_dokter')) {
            return;
        }

        Schema::create('mt_jadwal_dokter', function (Blueprint $table) {
            $table->increments('id_mt_jadwal_dokter');
            $table->string('kode_dokter', 50)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->string('range_hari')->nullable();
            $table->dateTime('jam_mulai')->nullable();
            $table->dateTime('jam_akhir')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->tinyInteger('senin')->nullable()->default(0);
            $table->tinyInteger('selasa')->nullable()->default(0);
            $table->tinyInteger('rabu')->nullable()->default(0);
            $table->tinyInteger('kamis')->nullable()->default(0);
            $table->tinyInteger('jumat')->nullable()->default(0);
            $table->tinyInteger('sabtu')->nullable()->default(0);
            $table->tinyInteger('minggu')->nullable()->default(0);
            $table->dateTime('tgl_input')->nullable();
            $table->integer('status')->nullable();

            $table->primary(['id_mt_jadwal_dokter'], 'pk_mt_jadwal_dokter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_jadwal_dokter');
    }
};
