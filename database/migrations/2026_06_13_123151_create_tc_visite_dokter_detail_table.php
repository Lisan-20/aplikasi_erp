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
        if (Schema::hasTable('tc_visite_dokter_detail')) {
            return;
        }

        Schema::create('tc_visite_dokter_detail', function (Blueprint $table) {
            $table->increments('no_urut');
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('bag_pas', 50)->nullable();
            $table->integer('Id_per')->nullable();
            $table->integer('Id_dok')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('dr_merawat')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('program')->nullable();
            $table->text('keluhan')->nullable();
            $table->integer('no_urut_visit')->nullable();
            $table->integer('kode_trans_pelayanan_1')->nullable();
            $table->integer('kode_trans_pelayanan_2')->nullable();
            $table->string('ruangan', 50)->nullable();
            $table->string('kelas', 50)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_visite_dokter_detail');
    }
};
