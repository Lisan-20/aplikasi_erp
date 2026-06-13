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
        Schema::create('mt_perusahaan', function (Blueprint $table) {
            $table->increments('id_perusahaan');
            $table->integer('kode_perusahaan');
            $table->smallInteger('kode_propinsi')->nullable();
            $table->smallInteger('id_dc_kota')->nullable();
            $table->string('acc_pola', 3)->nullable();
            $table->string('acc_pola1', 3)->nullable();
            $table->string('kode_pola', 30)->nullable();
            $table->string('nama_perusahaan', 100)->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('kota', 20)->nullable();
            $table->string('kodepos', 6)->nullable();
            $table->string('telpon1', 50)->nullable();
            $table->string('telpon2', 50)->nullable();
            $table->string('kontakperson', 50)->nullable();
            $table->string('fax', 20)->nullable();
            $table->dateTime('tgl_daftar')->nullable();
            $table->string('kontakperson2', 30)->nullable();
            $table->string('rj', 1)->nullable();
            $table->string('ri', 1)->nullable();
            $table->string('mcu', 1)->nullable();
            $table->string('odc', 1)->nullable();
            $table->text('lain')->nullable();
            $table->dateTime('tgl_pjg')->nullable();
            $table->dateTime('tgl_exp')->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->integer('flag_status')->nullable();
            $table->string('kode', 3)->nullable();
            $table->string('kode_p', 10)->nullable();
            $table->integer('flag')->nullable();
            $table->decimal('diskon', 19, 4)->nullable();
            $table->integer('flag_kontrak')->nullable();
            $table->decimal('adm', 18)->nullable();
            $table->decimal('disk_penagihan_rj', 19, 4)->nullable();
            $table->decimal('disk_penagihan_ri', 19, 4)->nullable();
            $table->integer('kode_perusahaan_tagih')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('status_aktif')->nullable();
            $table->integer('flag_cob')->nullable();
            $table->integer('flag_gizi')->nullable();
            $table->text('keterangan_blacklist')->nullable();
            $table->integer('flag_kapitasi')->nullable();
            $table->integer('flag_jpk')->nullable();
            $table->integer('user_edit')->nullable();
            $table->dateTime('tgl_edit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_perusahaan');
    }
};
