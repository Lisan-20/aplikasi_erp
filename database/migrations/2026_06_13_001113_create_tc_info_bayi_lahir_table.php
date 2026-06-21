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
        if (Schema::hasTable('tc_info_bayi_lahir')) {
            return;
        }

        Schema::create('tc_info_bayi_lahir', function (Blueprint $table) {
            $table->increments('id_info_bayi');
            $table->string('nama_org_tua', 100)->nullable();
            $table->integer('umur')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->integer('kode_perawat')->nullable();
            $table->integer('kode_bidan')->nullable();
            $table->integer('user_input')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_mr')->nullable();
            $table->string('jenis_kelamin', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_info_bayi_lahir');
    }
};
