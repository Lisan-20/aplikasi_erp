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
        if (Schema::hasTable('tc_produksi_obat')) {
            return;
        }

        Schema::create('tc_produksi_obat', function (Blueprint $table) {
            $table->increments('id_tc_produksi');
            $table->string('kode_produksi', 25)->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->dateTime('tgl_produksi')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('jenis_produksi')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('status_kirim')->nullable();
            $table->dateTime('tgl_acc')->nullable();
            $table->string('no_acc', 50)->nullable();
            $table->string('ket_acc')->nullable();
            $table->integer('user_id_acc')->nullable();
            $table->string('yg_serah')->nullable();
            $table->string('yg_terima')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_produksi_obat');
    }
};
