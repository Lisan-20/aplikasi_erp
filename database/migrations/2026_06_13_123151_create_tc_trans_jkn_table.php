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
        Schema::create('tc_trans_jkn', function (Blueprint $table) {
            $table->integer('kode_trans_pelayanan');
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi');
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_pasien_layan', 50)->nullable();
            $table->integer('kode_kelompok')->nullable()->default(0);
            $table->integer('kode_perusahaan')->nullable()->default(0);
            $table->dateTime('tgl_transaksi')->nullable();
            $table->integer('jenis_tindakan')->nullable();
            $table->string('nama_tindakan', 50)->nullable();
            $table->decimal('billing', 19, 4)->default(0);
            $table->decimal('plafon', 19, 4)->default(0);
            $table->decimal('selisih', 19, 4)->default(0);
            $table->decimal('tagihan', 19, 4)->nullable();
            $table->string('kode_plafon', 10)->nullable();
            $table->tinyInteger('status_selesai')->nullable()->default(0)->comment('2 --> Siap Billing, 3 --> Sudah Dibayar');
            $table->char('persen_bpjs', 10)->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('kode_bagian_asal', 10)->nullable();
            $table->integer('id_jenis_layanan')->nullable();
            $table->integer('flag_dr')->nullable();
            $table->decimal('persen_dr', 18)->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->integer('flag_ins')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_trans_jkn');
    }
};
