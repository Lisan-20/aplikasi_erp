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
        if (Schema::hasTable('tc_pemantauan_fungsional')) {
            return;
        }

        Schema::create('tc_pemantauan_fungsional', function (Blueprint $table) {
            $table->increments('no_urut_pemantauan');
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('warna', 50)->nullable();
            $table->text('referensi')->nullable();
            $table->integer('skor')->nullable();
            $table->integer('id_triase')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->integer('jenis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemantauan_fungsional');
    }
};
