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
        if (Schema::hasTable('tc_trans_pelayanan')) {
            return;
        }

        Schema::create('tc_trans_pelayanan', function (Blueprint $table) {
            $table->integer('kode_trans_pelayanan');
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi');
            $table->string('no_mr', 8)->nullable();
            $table->text('nama_pasien_layan')->nullable();
            $table->integer('kode_kelompok')->nullable()->default(0);
            $table->integer('kode_perusahaan')->nullable()->default(0);
            $table->dateTime('tgl_transaksi')->nullable();
            $table->integer('jenis_tindakan')->nullable();
            $table->text('nama_tindakan')->nullable();
            $table->decimal('bill_rs', 19, 4)->nullable()->default(0);
            $table->decimal('bill_dr1', 19, 4)->default(0);
            $table->decimal('bill_dr2', 19, 4)->default(0);
            $table->decimal('bill_dr3', 19, 4)->nullable();
            $table->decimal('bill_rs_askes', 19, 4)->default(0);
            $table->decimal('bill_dr1_askes', 19, 4)->default(0);
            $table->decimal('bill_dr2_askes', 19, 4)->default(0);
            $table->decimal('bill_rs_jatah', 19, 4)->default(0);
            $table->decimal('bill_dr1_jatah', 19, 4)->default(0);
            $table->decimal('bill_dr2_jatah', 19, 4)->default(0);
            $table->decimal('lain_lain', 19, 4)->default(0);
            $table->string('kode_dokter1', 20)->nullable();
            $table->string('kode_dokter2', 20)->nullable();
            $table->string('kode_dokter3', 20)->nullable();
            $table->decimal('jumlah', 19, 4)->default(0);
            $table->string('kode_barang', 20)->nullable();
            $table->integer('kode_master_tarif_detail')->nullable();
            $table->integer('kode_master_tarif_detail_jatah')->nullable();
            $table->integer('kd_tr_resep')->nullable();
            $table->integer('kode_trans_far')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('kode_bagian_asal', 10)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('no_kamar', 50)->nullable();
            $table->string('no_bed', 50)->nullable();
            $table->integer('kode_penunjang')->nullable();
            $table->integer('kode_profit')->nullable();
            $table->tinyInteger('status_selesai')->nullable()->default(0)->comment('2 --> Siap Billing, 3 --> Sudah Dibayar');
            $table->tinyInteger('status_nk')->nullable()->default(0)->comment('0 -> Tidak NK Perusahaan, 1 -> NK Perusahaan');
            $table->integer('status_kredit')->nullable()->default(0);
            $table->decimal('bill_rs_rujukan', 19, 4)->nullable();
            $table->decimal('bill_rs_laba_rujukan', 19, 4)->nullable();
            $table->integer('id_dd_rujuk_rs')->nullable();
            $table->decimal('kamar_tindakan', 19, 4)->nullable();
            $table->decimal('biaya_lain', 19, 4)->nullable();
            $table->decimal('obat', 19, 4)->nullable();
            $table->decimal('alkes', 19, 4)->nullable();
            $table->decimal('alat_rs', 19, 4)->nullable();
            $table->decimal('adm', 19, 4)->nullable();
            $table->decimal('overhead', 19, 4)->nullable();
            $table->decimal('bhp', 19, 4)->nullable();
            $table->decimal('pendapatan_rs', 19, 4)->nullable();
            $table->tinyInteger('flag_jurnal')->nullable();
            $table->tinyInteger('flag_jurnal_pdp')->nullable();
            $table->tinyInteger('obat_cover_persh')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->decimal('bill_rs_selisih', 19, 4)->nullable();
            $table->decimal('bill_dr1_selisih', 19, 4)->nullable();
            $table->decimal('bill_dr2_selisih', 19, 4)->nullable();
            $table->decimal('diskon_rs', 19, 4)->nullable();
            $table->decimal('diskon_dr1', 19, 4)->nullable();
            $table->decimal('diskon_dr2', 19, 4)->nullable();
            $table->decimal('diskon_rs_jatah', 19, 4)->nullable();
            $table->decimal('diskon_dr1_jatah', 19, 4)->nullable();
            $table->decimal('diskon_dr2_jatah', 19, 4)->nullable();
            $table->decimal('diskon_rs_selisih', 19, 4)->nullable();
            $table->decimal('diskon_dr1_selisih', 19, 4)->nullable();
            $table->decimal('diskon_dr2_selisih', 19, 4)->nullable();
            $table->integer('id_bedah')->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->integer('flag_tarik')->nullable();
            $table->integer('paket_sectio')->nullable();
            $table->dateTime('tgl_pindah')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('flag_dr1')->nullable();
            $table->integer('flag_dr2')->nullable();
            $table->integer('no_kui_gabung')->nullable();
            $table->integer('kode_tarif_mcu')->nullable();
            $table->decimal('lain_lain_jatah', 19, 4)->nullable();
            $table->decimal('lain_lain_selisih', 19, 4)->nullable();
            $table->char('persen_bpjs', 10)->nullable();
            $table->integer('npp')->nullable();
            $table->decimal('bill_rs_p', 19, 4)->nullable();
            $table->decimal('bill_dr_p', 19, 4)->nullable();
            $table->integer('flag_hutang')->nullable();
            $table->integer('status_invoice')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('flag_obat')->nullable();
            $table->decimal('jml_konversi', 18)->nullable();
            $table->integer('flag_dr_lab')->nullable();
            $table->integer('flag_dr_lab_perujuk')->nullable();
            $table->integer('kd_his')->nullable();
            $table->integer('flag_amprah')->nullable();
            $table->integer('id_tc_permintaan_inst')->nullable();
            $table->decimal('profit_2_persen', 19, 4)->nullable();
            $table->char('perawat_ambulan', 10)->nullable();
            $table->string('no_radio', 10)->nullable();
            $table->string('ref_bedah', 50)->nullable();
            $table->integer('cito')->nullable();
            $table->bigInteger('kode_ri')->nullable();
            $table->integer('id_bd_tc_hutang_dr')->nullable();
            $table->integer('no_sppu_dr')->nullable();
            $table->integer('user_batal')->nullable();
            $table->string('alasan_batal', 100)->nullable();
            $table->dateTime('tgl_update')->nullable();
            $table->integer('user_update')->nullable();
            $table->integer('user_input')->nullable();
            $table->char('dr_kirim_fis', 10)->nullable();
            $table->integer('no_bedah')->nullable();
            $table->integer('no_reg_resep')->nullable();
            $table->integer('kode_inap')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->string('kode_ruangan', 20)->nullable();
            $table->integer('flag_param1')->nullable();
            $table->integer('kode_paramedis2')->nullable();
            $table->integer('kode_paramedis3')->nullable();
            $table->integer('flag_param2')->nullable();
            $table->integer('flag_param3')->nullable();
            $table->integer('flag_penata')->nullable();
            $table->decimal('bill_rs_asli', 19, 4)->nullable();
            $table->decimal('bill_dr1_asli', 19, 4)->nullable();
            $table->decimal('bill_dr2_asli', 19, 4)->nullable();
            $table->integer('jatah_klas')->nullable();
            $table->integer('flag_ver_ri')->nullable();
            $table->dateTime('tgl_ver_ri')->nullable();
            $table->integer('user_ver_ri')->nullable();

            $table->primary(['kode_trans_pelayanan'], 'pk_tc_trans_pelayanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_trans_pelayanan');
    }
};
