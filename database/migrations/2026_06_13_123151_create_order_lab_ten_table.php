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
        if (Schema::hasTable('order_lab_ten')) {
            return;
        }

        Schema::create('order_lab_ten', function (Blueprint $table) {
            $table->increments('id_lis');
            $table->integer('kode_penunjang');
            $table->string('asal_lab', 10)->nullable();
            $table->string('no_registrasi', 15)->nullable();
            $table->string('no_kunjungan', 25)->nullable();
            $table->string('no_rm', 15)->nullable();
            $table->dateTime('tgl_order')->nullable();
            $table->string('nama_pas', 50)->nullable();
            $table->string('jenis_kel', 1)->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('usia', 10)->nullable();
            $table->string('kode_dok_kirim', 10)->nullable();
            $table->string('nama_dok_kirim2', 30)->nullable();
            $table->string('kode_ruang', 10)->nullable();
            $table->string('nama_ruang', 25)->nullable();
            $table->string('kode_cara_bayar', 10)->nullable();
            $table->string('cara_bayar', 25)->nullable();
            $table->string('ket_klinis', 80)->nullable();
            $table->string('kode_test', 20)->nullable();
            $table->string('test', 100)->nullable();
            $table->integer('Harga')->nullable()->default(0);
            $table->dateTime('waktu_kirim')->nullable();
            $table->string('prioritas', 1)->nullable();
            $table->string('jns_rawat', 5)->nullable();
            $table->string('dok_jaga', 50)->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->string('NIK', 20)->nullable();
            $table->string('batal', 1)->nullable();
            $table->integer('Jumlah_test')->nullable()->default(0);
            $table->text('alamat')->nullable();
            $table->string('nama_dok_kirim', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lab_ten');
    }
};
