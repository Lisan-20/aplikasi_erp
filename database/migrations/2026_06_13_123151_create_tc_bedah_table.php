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
        if (Schema::hasTable('tc_bedah')) {
            return;
        }

        Schema::create('tc_bedah', function (Blueprint $table) {
            $table->integer('id_bedah');
            $table->integer('kode_tarif')->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->integer('kode_master_tarif_detail')->nullable();
            $table->decimal('bill_rs', 19, 4)->nullable();
            $table->decimal('bill_dr_bedah', 19, 4)->nullable();
            $table->decimal('bill_dr_anesthesi', 19, 4)->nullable();
            $table->decimal('sewa_alat', 19, 4)->nullable();
            $table->decimal('asisten', 19, 4)->nullable();
            $table->decimal('ruangan', 19, 4)->nullable();
            $table->integer('kode_dr_bedah')->nullable();
            $table->integer('kode_dr_anestesi')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->dateTime('tgl_jam_masuk')->nullable();
            $table->dateTime('tgl_jam_keluar')->nullable();
            $table->dateTime('tgl_jam_mulai')->nullable();
            $table->dateTime('tgl_jam_selesai')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_pasien')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('no_bed', 50)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->decimal('umur', 18)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('jenis_anestesi')->nullable();
            $table->string('icd_diagnosa', 10)->nullable();
            $table->integer('keterangan')->nullable();
            $table->integer('status_penata')->nullable();
            $table->integer('status_anestesi')->nullable();
            $table->string('diagnosa_pra')->nullable();
            $table->string('diagnosa_pasca')->nullable();
            $table->integer('jenis_op')->nullable();
            $table->integer('kategori_op')->nullable();
            $table->text('uraian_bedah')->nullable();
            $table->integer('jaringan_patologi')->nullable();
            $table->text('indikasi_op1')->nullable();
            $table->text('indikasi_op2')->nullable();
            $table->text('indikasi_op3')->nullable();
            $table->text('indikasi_op4')->nullable();
            $table->integer('asisten_op_1')->nullable();
            $table->integer('asisten_op_2')->nullable();
            $table->integer('asisten_op_3')->nullable();
            $table->integer('asisten_op_4')->nullable();
            $table->integer('dr_bedah_2')->nullable();
            $table->text('file_implan')->nullable();
            $table->text('keterangan_implan')->nullable();

            $table->primary(['id_bedah'], 'pk_tc_bedah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_bedah');
    }
};
