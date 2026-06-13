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
        Schema::create('tc_pendaftaran', function (Blueprint $table) {
            $table->integer('id_pendaftaran');
            $table->string('no_mr', 8);
            $table->integer('kode_dokter')->nullable();
            $table->integer('no_induk')->nullable();
            $table->dateTime('tgl_jam_daftar')->nullable();
            $table->dateTime('tgl_jam_periksa')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('status_batal')->nullable();
            $table->char('umur_tahun', 10)->nullable();
            $table->integer('umur_bln')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('id_kota')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('nama_pasien', 100)->nullable();
            $table->string('nama_ortu', 100)->nullable();
            $table->integer('kode_pekerjaan')->nullable();
            $table->string('no_telpon', 50)->nullable();
            $table->integer('id_tarif')->nullable();
            $table->integer('id_tarif_det')->nullable();
            $table->integer('tarif_rs')->nullable();
            $table->integer('tarif_dr')->nullable();
            $table->integer('total_billing')->nullable();
            $table->string('lain_lain', 300)->nullable();
            $table->integer('group_antrian')->nullable();
            $table->string('barcode', 50)->nullable();
            $table->integer('no_antrian')->nullable();
            $table->integer('flag_antrian')->nullable();
            $table->integer('flag_pembayaran')->nullable();
            $table->integer('flag_obat')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('flag_adm')->nullable();
            $table->integer('id_masal')->nullable();
            $table->integer('flag_proses_dr_vip')->nullable();
            $table->integer('flag_proses_dr_umum')->nullable();
            $table->integer('diskon')->nullable();
            $table->string('note_disk', 300)->nullable();
            $table->string('reg', 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pendaftaran');
    }
};
