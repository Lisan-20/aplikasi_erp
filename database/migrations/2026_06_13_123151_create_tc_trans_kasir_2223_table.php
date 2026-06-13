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
        if (Schema::hasTable('tc_trans_kasir_2223')) {
            return;
        }

        Schema::create('tc_trans_kasir_2223', function (Blueprint $table) {
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->string('seri_kuitansi', 20)->nullable();
            $table->integer('no_kuitansi_bendahara')->nullable();
            $table->string('no_induk', 20)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('no_mr', 20)->nullable();
            $table->integer('no_registrasi_old')->nullable();
            $table->decimal('bill', 19, 4)->nullable();
            $table->decimal('tambahan', 19, 4)->nullable();
            $table->decimal('potongan', 19, 4)->nullable();
            $table->decimal('tunai', 19, 4)->nullable();
            $table->decimal('debet', 19, 4)->nullable();
            $table->string('no_debet', 20)->nullable();
            $table->decimal('kredit', 19, 4)->nullable();
            $table->string('no_kredit', 20)->nullable();
            $table->decimal('cetak_kartu', 19, 4)->nullable();
            $table->decimal('nd', 19, 4)->nullable();
            $table->decimal('nk', 19, 4)->nullable();
            $table->decimal('nk_karyawan', 19, 4)->nullable();
            $table->decimal('nk_perusahaan', 19, 4)->nullable();
            $table->decimal('nk_askes', 19, 4)->nullable();
            $table->string('no_mr_karyawan', 8)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('no_batch_cc', 20)->nullable();
            $table->integer('kd_bank_cc')->nullable();
            $table->integer('kd_bank_dc')->nullable();
            $table->string('no_batch_dc', 20)->nullable();
            $table->decimal('pembulatan', 19, 4)->nullable();
            $table->text('nama_pasien')->nullable();
            $table->text('pembayar')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('kd_inv_umum_tx')->nullable();
            $table->integer('kd_inv_askes')->nullable();
            $table->integer('kd_inv_persh_tx')->nullable();
            $table->integer('kd_inv_kary_tx')->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->integer('kd_inv_cc_tx')->nullable();
            $table->integer('kd_inv_dc_tx')->nullable();
            $table->integer('kode_shift')->nullable();
            $table->integer('kode_loket')->nullable();
            $table->decimal('materai', 19, 4)->nullable();
            $table->string('kode_bagian', 8)->nullable();
            $table->integer('status_batal')->nullable();
            $table->dateTime('tgl_batal')->nullable();
            $table->integer('user_batal')->nullable();
            $table->char('seri_kuitansi_batal', 3)->nullable();
            $table->integer('no_kuitansi_batal')->nullable();
            $table->integer('no_kui_gabung')->nullable();
            $table->decimal('nk_bpjs', 19, 4)->nullable();
            $table->decimal('plafon', 19, 4)->nullable();
            $table->string('rl_bag', 8)->nullable();
            $table->integer('flag_tagih')->nullable();
            $table->integer('npp')->nullable();
            $table->decimal('selisih_bpjs', 19, 4)->nullable();
            $table->integer('flag_rm')->nullable();
            $table->integer('user_kirim_rm')->nullable();
            $table->dateTime('tgl_kirim_rm')->nullable();
            $table->integer('kode_penanggung')->nullable();
            $table->integer('kd_inv_persh_tx_penanggung')->nullable();
            $table->integer('flag_tagih_penanggung')->nullable();
            $table->integer('kd_trans_bendahara')->nullable();
            $table->text('uraian')->nullable();
            $table->integer('acc_no')->nullable();
            $table->integer('flag_pakai')->nullable();
            $table->integer('flag_tunai_mattel')->nullable();
            $table->string('ket_batal', 100)->nullable();
            $table->integer('status_kasir_poli')->nullable();
            $table->bigInteger('kode_ri')->nullable();
            $table->integer('no_reg_resep')->nullable();
            $table->integer('kode_inap')->nullable();
            $table->bigInteger('no_kuitansi')->nullable();
            $table->bigInteger('no_registrasi')->nullable();
            $table->integer('flag_fee_billing_dr')->nullable();
            $table->integer('flag_fisio')->nullable();
            $table->decimal('adm_cc', 19, 4)->nullable();
            $table->integer('pembayaran_sisa')->nullable();
            $table->decimal('pembayaran_tunai', 19, 4)->nullable();
            $table->dateTime('tgl_ver_berkas')->nullable();
            $table->integer('flag_ver_berkas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_trans_kasir_2223');
    }
};
