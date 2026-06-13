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
        Schema::create('fr_far_resep_ri_dokter', function (Blueprint $table) {
            $table->increments('id_resep_ri_dr');
            $table->integer('kode_resep')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 10)->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->char('satuan', 20)->nullable();
            $table->string('nama_brg')->nullable();
            $table->decimal('harga', 19, 4)->nullable();
            $table->integer('takaran')->nullable();
            $table->integer('penggunaan')->nullable();
            $table->string('instruksi', 200)->nullable();
            $table->string('jml_pakai', 50)->nullable();
            $table->string('jml_takar', 50)->nullable();
            $table->string('jam_pemberian', 50)->nullable();
            $table->decimal('jml_konversi', 18)->nullable();
            $table->integer('komp_dtd')->nullable();
            $table->text('racikan_obat_tambahan')->nullable();
            $table->integer('racik')->nullable();
            $table->integer('flag_kirim')->nullable();
            $table->string('jam1', 50)->nullable();
            $table->string('jam2', 50)->nullable();
            $table->string('jam3', 50)->nullable();
            $table->string('jam4', 50)->nullable();
            $table->string('jam5', 50)->nullable();
            $table->integer('st_pesan')->nullable();
            $table->dateTime('tgl_st_pesan')->nullable();
            $table->integer('id_user_st_pesan')->nullable();
            $table->integer('interaksi')->nullable();
            $table->integer('duplikasi')->nullable();
            $table->integer('dosis')->nullable();
            $table->integer('alergi')->nullable();
            $table->integer('kontra')->nullable();
            $table->integer('user_id_apot')->nullable();
            $table->dateTime('tgl_review')->nullable();
            $table->integer('st_review')->nullable();
            $table->integer('st_stop')->nullable();
            $table->dateTime('tgl_st_stop')->nullable();
            $table->integer('id_user_st_stop')->nullable();
            $table->integer('id_user_st_review')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('kode_bagian_isi', 50)->nullable();
            $table->string('isi_cara', 250)->nullable();
            $table->string('isi_waktu', 250)->nullable();
            $table->string('isi_signa', 250)->nullable();
            $table->integer('st_rek_awal')->nullable();
            $table->dateTime('tgl_rek_awal')->nullable();
            $table->integer('id_user_rek')->nullable();
            $table->string('bentuk_reaksi', 250)->nullable();
            $table->dateTime('tgl_ass_alergi')->nullable();
            $table->integer('id_user_alergi')->nullable();
            $table->string('st_alergi', 250)->nullable();
            $table->integer('flag_perawat')->nullable();
            $table->integer('flag_igd_resep')->nullable();
            $table->string('jam_khusus', 50)->nullable();
            $table->string('kode_bagian_inp', 50)->nullable();
            $table->integer('flag_permintaan')->nullable();
            $table->integer('flag_1x')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_far_resep_ri_dokter');
    }
};
