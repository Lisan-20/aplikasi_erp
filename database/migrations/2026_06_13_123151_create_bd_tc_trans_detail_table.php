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
        if (Schema::hasTable('bd_tc_trans_detail')) {
            return;
        }

        Schema::create('bd_tc_trans_detail', function (Blueprint $table) {
            $table->increments('id_bd_tc_trans_det');
            $table->integer('id_bd_tc_trans');
            $table->integer('kd_group_trans');
            $table->integer('kd_trans_bendahara')->nullable();
            $table->integer('id_bank')->nullable();
            $table->string('giro', 50)->nullable();
            $table->dateTime('tgl_bank')->nullable();
            $table->string('no_bukti', 53);
            $table->string('no_ref', 50)->nullable();
            $table->dateTime('tgl_transaksi');
            $table->string('penerima', 50)->nullable();
            $table->text('uraian')->nullable();
            $table->decimal('materai', 18)->nullable();
            $table->decimal('jumlah', 18);
            $table->string('no_induk', 50)->nullable();
            $table->integer('user_edit_t')->nullable();
            $table->integer('user_edit_v')->nullable();
            $table->tinyInteger('online')->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kode_suplier', 50)->nullable();
            $table->string('kode_dr', 50)->nullable();
            $table->string('kode_perusahaan', 50)->nullable();
            $table->string('acc_no', 50);
            $table->integer('tx_tipe')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('status')->nullable();
            $table->integer('flag_dr')->nullable();
            $table->decimal('diskon', 19, 4)->nullable();
            $table->integer('flag_kecil')->nullable();
            $table->string('kode_paramedis', 20)->nullable();
            $table->string('kode_param', 50)->nullable();
            $table->bigInteger('npp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bd_tc_trans_detail');
    }
};
