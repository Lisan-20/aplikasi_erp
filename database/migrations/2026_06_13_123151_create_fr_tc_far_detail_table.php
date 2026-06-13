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
        Schema::create('fr_tc_far_detail', function (Blueprint $table) {
            $table->integer('kd_tr_resep');
            $table->integer('kode_trans_far')->nullable();
            $table->decimal('jumlah_pesan', 19, 4)->nullable();
            $table->decimal('jumlah_tebus', 19, 4)->nullable();
            $table->decimal('sisa', 19, 4)->nullable();
            $table->decimal('jumlah_retur', 19, 4)->nullable();
            $table->decimal('harga_r_retur', 19, 4)->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('harga_r', 19, 4)->nullable();
            $table->decimal('biaya_tebus', 19, 4)->nullable();
            $table->decimal('bill_rs', 19, 4)->nullable();
            $table->decimal('bill_dr1', 19, 4)->nullable();
            $table->decimal('bill_dr2', 19, 4)->nullable();
            $table->decimal('bill_rs_askes', 19, 4)->nullable();
            $table->decimal('bill_dr1_askes', 19, 4)->nullable();
            $table->decimal('bill_dr2_askes', 19, 4)->nullable();
            $table->decimal('bill_rs_jatah', 19, 4)->nullable();
            $table->decimal('bill_dr1_jatah', 19, 4)->nullable();
            $table->decimal('bill_dr2_jatah', 19, 4)->nullable();
            $table->integer('status_kirim')->nullable();
            $table->integer('status_retur')->nullable();
            $table->integer('kode_cito')->nullable();
            $table->integer('racik')->nullable();
            $table->tinyInteger('obat_cover_persh')->nullable();
            $table->decimal('diskon', 18, 0)->nullable();
            $table->integer('kode_diskon')->nullable();
            $table->integer('takaran')->nullable();
            $table->integer('penggunaan')->nullable();
            $table->string('instruksi', 200)->nullable();
            $table->string('jml_pakai', 50)->nullable();
            $table->string('jml_takar', 50)->nullable();
            $table->decimal('jml_konversi', 18)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->char('alasan_retur', 200)->nullable();
            $table->decimal('profit_2_persen', 19, 4)->nullable();
            $table->integer('komp_dtd')->nullable();
            $table->integer('racikan_dr')->nullable();
            $table->decimal('tot_pakai_ri', 18)->nullable();
            $table->decimal('sisa_pakai_ri', 18)->nullable();
            $table->string('waktu_pakai', 150)->nullable();
            $table->string('bud', 150)->nullable();
            $table->string('jam1', 50)->nullable();
            $table->string('jam2', 50)->nullable();
            $table->string('jam3', 50)->nullable();
            $table->string('jam4', 50)->nullable();
            $table->string('jam5', 50)->nullable();
            $table->dateTime('tgl_update1')->nullable();
            $table->dateTime('tgl_update2')->nullable();
            $table->dateTime('tgl_update3')->nullable();
            $table->dateTime('tgl_update4')->nullable();
            $table->dateTime('tgl_update5')->nullable();
            $table->integer('id_user1')->nullable();
            $table->integer('id_user2')->nullable();
            $table->integer('id_user3')->nullable();
            $table->integer('id_user4')->nullable();
            $table->integer('id_user5')->nullable();
            $table->integer('id_resep_ri_dr')->nullable();
            $table->string('isi_cara', 250)->nullable();
            $table->string('isi_waktu', 250)->nullable();
            $table->string('isi_signa', 250)->nullable();
            $table->dateTime('tgl_update_rek')->nullable();
            $table->integer('id_user_rek')->nullable();
            $table->text('ttd_pasien1')->nullable();
            $table->text('ttd_pasien2')->nullable();
            $table->text('ttd_pasien3')->nullable();
            $table->text('ttd_pasien4')->nullable();
            $table->text('ttd_pasien5')->nullable();
            $table->string('ttd_pasien_nama1', 250)->nullable();
            $table->string('ttd_pasien_nama2', 250)->nullable();
            $table->string('ttd_pasien_nama3', 250)->nullable();
            $table->string('ttd_pasien_nama4', 250)->nullable();
            $table->string('ttd_pasien_nama5', 250)->nullable();
            $table->integer('perawat1')->nullable();
            $table->integer('perawat2')->nullable();
            $table->integer('perawat3')->nullable();
            $table->integer('perawat4')->nullable();
            $table->integer('perawat5')->nullable();
            $table->string('isi_dosis', 250)->nullable();
            $table->string('isi_frekuensi', 250)->nullable();
            $table->string('tindak_lanjut', 250)->nullable();
            $table->string('kode_brg_plg', 250)->nullable();
            $table->string('kode_dokter_plg', 250)->nullable();

            $table->primary(['kd_tr_resep'], 'pk_fr_tc_far_detail_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_tc_far_detail');
    }
};
