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
        Schema::create('tc_permohonan', function (Blueprint $table) {
            $table->increments('id_tc_permohonan');
            $table->string('kode_permohonan', 25)->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->dateTime('tgl_permohonan')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('jenis_permohonan')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('status_kirim')->nullable();
            $table->dateTime('tgl_acc')->nullable();
            $table->string('no_acc', 50)->nullable();
            $table->string('ket_acc')->nullable();
            $table->integer('user_id_acc')->nullable();
            $table->integer('minggu_po')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('kode_bagian', 8)->nullable();
            $table->integer('flag_is')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permohonan');
    }
};
