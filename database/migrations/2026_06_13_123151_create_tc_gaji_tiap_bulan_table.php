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
        Schema::create('tc_gaji_tiap_bulan', function (Blueprint $table) {
            $table->increments('id_tc_thp');
            $table->integer('id_periode_gaji')->nullable();
            $table->string('periode', 50)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('bulan', 3)->nullable();
            $table->integer('no_induk')->nullable();
            $table->string('nama_pegawai', 100)->nullable();
            $table->decimal('gaji_pokok', 19, 4)->nullable();
            $table->decimal('tunj_jabatan', 19, 4)->nullable();
            $table->decimal('tunj_resiko', 19, 4)->nullable();
            $table->decimal('tunj_jaga_malam', 19, 4)->nullable();
            $table->decimal('tunj_performa', 19, 4)->nullable();
            $table->decimal('tunj_transport', 19, 4)->nullable();
            $table->decimal('tunj_uang_makan', 19, 4)->nullable();
            $table->decimal('tunj_lain', 19, 4)->nullable();
            $table->decimal('gaji_kotor', 19, 4)->nullable();
            $table->decimal('pot_BPJS_kesehatan', 19, 4)->nullable();
            $table->decimal('pot_BPJS_jht', 19, 4)->nullable();
            $table->decimal('pot_BPJS_jp', 19, 4)->nullable();
            $table->decimal('pot_bank', 19, 4)->nullable();
            $table->decimal('pot_payroll', 19, 4)->nullable();
            $table->decimal('pot_pinjaman', 19, 4)->nullable();
            $table->decimal('pot_obat', 19, 4)->nullable();
            $table->decimal('pot_selisih_iuran', 19, 4)->nullable();
            $table->decimal('pot_lain', 19, 4)->nullable();
            $table->decimal('lembur', 19, 4)->nullable();
            $table->decimal('insentif', 19, 4)->nullable();
            $table->decimal('thp', 19, 4)->nullable();
            $table->decimal('bruto1thn', 19, 4)->nullable();
            $table->decimal('netto1thn', 19, 4)->nullable();
            $table->string('ptkp_jenis', 4)->nullable();
            $table->decimal('ptkp', 19, 4)->nullable();
            $table->decimal('pkp', 19, 4)->nullable();
            $table->decimal('pph21', 19, 4)->nullable();
            $table->decimal('pph21_bln', 19, 4)->nullable();
            $table->decimal('gross', 19, 4)->nullable();
            $table->decimal('gross_bln', 19, 4)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->string('no_bukti', 250)->nullable();
            $table->text('npp')->nullable();
            $table->integer('flag_final')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->decimal('pot_indisipliner', 19, 4)->nullable();
            $table->decimal('bonus_kinerja', 19, 4)->nullable();
            $table->decimal('bonus_tahunan', 19, 4)->nullable();
            $table->decimal('dana_pendidikan', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_gaji_tiap_bulan');
    }
};
