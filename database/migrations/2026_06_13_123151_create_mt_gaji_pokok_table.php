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
        Schema::create('mt_gaji_pokok', function (Blueprint $table) {
            $table->increments('id_mt_gaji_pokok');
            $table->string('npp', 6)->nullable();
            $table->integer('id_mt_data_pegawai')->nullable();
            $table->string('nama_pegawai', 50)->nullable();
            $table->decimal('penambahan', 19, 4)->default(0);
            $table->integer('id_dd_gapok')->nullable();
            $table->decimal('gapok', 19, 4)->nullable();
            $table->integer('id_dd_tg')->nullable();
            $table->string('tg', 5)->nullable();
            $table->integer('id_dd_gg')->nullable();
            $table->string('gg', 5)->nullable();
            $table->tinyInteger('status_gaji')->nullable()->default(0);
            $table->dateTime('tgl_berlaku')->nullable();
            $table->dateTime('tgl_berakhir')->nullable();
            $table->string('no_sk', 50)->nullable();
            $table->dateTime('tgl_sk')->nullable();
            $table->integer('id_dd_pajak_ptkp')->nullable();
            $table->string('jenis_ptkp', 3)->nullable();
            $table->tinyInteger('gross_pajak')->nullable();
            $table->integer('ko_wil')->nullable();
            $table->tinyInteger('status_keluar')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_gaji_pokok');
    }
};
