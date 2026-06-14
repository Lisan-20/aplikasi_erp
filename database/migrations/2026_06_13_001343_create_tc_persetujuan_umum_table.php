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
        if (Schema::hasTable('tc_persetujuan_umum')) {
            return;
        }

        Schema::create('tc_persetujuan_umum', function (Blueprint $table) {
            $table->increments('id_persetujuan_umum');
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 15)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('nama_wali', 25)->nullable();
            $table->string('alamat_wali', 150)->nullable();
            $table->string('status_wali', 20)->nullable();
            $table->string('tlp_wali', 20)->nullable();
            $table->string('penerima_info1', 50)->nullable();
            $table->string('penerima_info2', 50)->nullable();
            $table->string('penerima_info3', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_persetujuan_umum');
    }
};
