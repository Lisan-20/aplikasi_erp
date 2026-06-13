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
        if (Schema::hasTable('th_permohonan_nm')) {
            return;
        }

        Schema::create('th_permohonan_nm', function (Blueprint $table) {
            $table->increments('id_th_permohonan');
            $table->dateTime('tgl_revisi')->nullable();
            $table->integer('user_id_revisi')->nullable();
            $table->integer('id_tc_permohonan')->nullable();
            $table->string('kode_permohonan', 25)->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->dateTime('tgl_permohonan')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('jenis_permohonan')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('status_kirim')->nullable()->default(0);
            $table->dateTime('tgl_acc')->nullable();
            $table->string('no_acc', 50)->nullable();
            $table->string('ket_acc')->nullable();
            $table->integer('user_id_acc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_permohonan_nm');
    }
};
