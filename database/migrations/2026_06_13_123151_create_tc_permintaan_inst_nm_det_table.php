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
        Schema::create('tc_permintaan_inst_nm_det', function (Blueprint $table) {
            $table->increments('id_tc_permintaan_inst_det');
            $table->integer('id_tc_permintaan_inst')->nullable();
            $table->decimal('jumlah_permintaan', 10, 0)->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->dateTime('tgl_kirim')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->decimal('jumlah_penerimaan', 10, 0)->nullable();
            $table->integer('kekurangan')->nullable();
            $table->decimal('harga', 18)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();

            $table->primary(['id_tc_permintaan_inst_det'], 'pk_tc_permintaan_inst_nm_det');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permintaan_inst_nm_det');
    }
};
