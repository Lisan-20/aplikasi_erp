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
        if (Schema::hasTable('fr_tc_far_batal')) {
            return;
        }

        Schema::create('fr_tc_far_batal', function (Blueprint $table) {
            $table->integer('kode_trans_far')->nullable();
            $table->integer('kode_pesan_resep')->nullable();
            $table->integer('kode_form_ri')->nullable();
            $table->integer('kode_form_rj')->nullable();
            $table->integer('kode_form_rl')->nullable();
            $table->integer('kode_form_bb')->nullable();
            $table->string('no_resep', 50)->nullable();
            $table->integer('kode_profit')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->dateTime('tgl_trans')->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
            $table->string('no_mr', 20)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('dokter_pengirim', 150)->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->text('alamat_pasien')->nullable();
            $table->string('telpon_pasien', 100)->nullable();
            $table->integer('status_transaksi')->nullable();
            $table->integer('petugas')->nullable();
            $table->integer('npp')->nullable();
            $table->integer('kode_form_baksos')->nullable();
            $table->integer('flag_serah')->nullable();
            $table->dateTime('tgl_serah')->nullable();
            $table->integer('user_serah')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->text('penerima')->nullable();
            $table->integer('flag_resep')->nullable();
            $table->integer('online')->nullable();
            $table->text('konfirmasi')->nullable();
            $table->integer('stat_dr')->nullable();
            $table->integer('no_reg_resep')->nullable();
            $table->integer('flag_selesai')->nullable();
            $table->integer('user_selesai')->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->text('ttd_serah')->nullable();
            $table->integer('kode_trans_far_lama')->nullable();
            $table->integer('kode_paket')->nullable();
            $table->integer('kode_resep')->nullable();
            $table->dateTime('tgl_status_transaksi')->nullable();
            $table->integer('id_user_status')->nullable();
            $table->integer('flag_obt_plang')->nullable();
            $table->integer('flag_perawat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_tc_far_batal');
    }
};
