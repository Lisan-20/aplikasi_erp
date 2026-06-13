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
        if (Schema::hasTable('th_laporan_penandaan_op')) {
            return;
        }

        Schema::create('th_laporan_penandaan_op', function (Blueprint $table) {
            $table->increments('id_penandaan_operasi');
            $table->string('no_mr', 20)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->text('nama_pasien')->nullable();
            $table->dateTime('tgl_tindakan')->nullable();
            $table->string('dr_operator', 50)->nullable();
            $table->string('saksi', 50)->nullable();
            $table->string('hub_kel', 50)->nullable();
            $table->string('tindakan', 50)->nullable();
            $table->string('mulai_bedah', 8)->nullable();
            $table->string('selesai_bedah', 8)->nullable();
            $table->integer('petugas')->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_laporan_penandaan_op');
    }
};
