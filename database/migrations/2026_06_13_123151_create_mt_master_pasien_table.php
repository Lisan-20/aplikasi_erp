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
        Schema::create('mt_master_pasien', function (Blueprint $table) {
            $table->bigIncrements('id_mt_master_pasien');
            $table->string('no_mr', 20);
            $table->string('hubungan', 50)->nullable();
            $table->integer('no_urutan')->nullable();
            $table->string('kode_login', 10)->nullable();
            $table->text('kota')->nullable();
            $table->text('nama_pasien')->nullable();
            $table->text('nama_panggilan')->nullable();
            $table->text('nama_kel_pasien')->nullable();
            $table->text('no_ktp')->nullable();
            $table->text('pekerjaan')->nullable();
            $table->dateTime('tgl_lhr')->nullable();
            $table->text('tempat_lahir')->nullable();
            $table->float('umur_pasien', 53, 0)->nullable();
            $table->text('almt_ttp_pasien')->nullable();
            $table->text('tlp_almt_ttp')->nullable();
            $table->string('jen_kelamin', 10)->nullable();
            $table->string('status_perkaw', 13)->nullable();
            $table->text('suku')->nullable();
            $table->integer('kode_agama')->nullable();
            $table->text('kebangsaan')->nullable();
            $table->text('alamat_lokal')->nullable();
            $table->text('tlp_almt_lkl')->nullable();
            $table->text('nama_kel_ter')->nullable();
            $table->text('nama_almt_kel')->nullable();
            $table->text('hubungan_kel')->nullable();
            $table->text('tlp_kel')->nullable();
            $table->integer('kode_pendidikan')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kd_bgn', 50)->nullable();
            $table->string('prosedur_rs', 18)->nullable();
            $table->text('nama_almt_kantor')->nullable();
            $table->text('jabatan')->nullable();
            $table->string('gol_darah', 3)->nullable();
            $table->string('alergi', 20)->nullable();
            $table->text('nama_ayah')->nullable();
            $table->integer('umur_ayah')->nullable();
            $table->text('pekerjaan_ayah')->nullable();
            $table->text('nama_ibu')->nullable();
            $table->integer('umur_ibu')->nullable();
            $table->text('pekerjaan_ibu')->nullable();
            $table->string('no_askes', 20)->nullable();
            $table->string('nm_inst_askes', 20)->nullable();
            $table->dateTime('tgl_ctk_kartu')->nullable();
            $table->integer('jth_kelas')->nullable();
            $table->dateTime('masa_mulai')->nullable();
            $table->dateTime('masa_selesai')->nullable();
            $table->string('flag_member', 1)->nullable();
            $table->string('jam_lahir', 50)->nullable();
            $table->string('berat_badan', 50)->nullable();
            $table->string('panjang_badan', 50)->nullable();
            $table->string('warna_kulit', 50)->nullable();
            $table->string('no_gelang', 50)->nullable();
            $table->string('pemberi_no', 50)->nullable();
            $table->string('mr_ibu', 50)->nullable();
            $table->string('dok_penolong', 100)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('penanggung', 100)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('milik', 100)->nullable();
            $table->tinyInteger('status_meninggal')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('jatah_ruang', 50)->nullable();
            $table->integer('id_dc_kota')->nullable();
            $table->integer('id_dc_kecamatan')->nullable();
            $table->integer('id_dc_kelurahan')->nullable();
            $table->string('tlp_almt_ttp1', 30)->nullable();
            $table->string('field_sem1', 100)->nullable();
            $table->string('field_sem2', 100)->nullable();
            $table->string('field_sem3', 100)->nullable();
            $table->string('field_sem4', 100)->nullable();
            $table->string('field_sem5', 100)->nullable();
            $table->string('field_sem6', 100)->nullable();
            $table->string('field_sem7', 100)->nullable();
            $table->string('field_sem8', 100)->nullable();
            $table->string('field_sem9', 100)->nullable();
            $table->string('field_sem10', 100)->nullable();
            $table->integer('kode_pt')->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('wil_krj', 20)->nullable();
            $table->integer('flag_pas_lm')->nullable();
            $table->integer('flag_daftar')->nullable();
            $table->string('nama_karyawan', 20)->nullable();
            $table->string('bagian_kerja', 20)->nullable();
            $table->string('no_peserta', 50)->nullable();
            $table->string('no_polis', 50)->nullable();
            $table->string('noKartuPeserta', 50)->nullable();
            $table->string('nikPeserta', 100)->nullable();
            $table->string('namaPeserta', 250)->nullable();
            $table->integer('pisaPeserta')->nullable();
            $table->string('sexPeserta', 10)->nullable();
            $table->dateTime('tglLahirPeserta')->nullable();
            $table->string('jenisPeserta', 250)->nullable();
            $table->integer('flag_kelamin')->nullable();
            $table->string('memo', 50)->nullable();
            $table->integer('blacklist')->nullable();
            $table->string('status_aktif', 1)->nullable();
            $table->text('alasan_blokir')->nullable();
            $table->integer('user_blokir')->nullable();
            $table->integer('id_dc_dusun')->nullable();
            $table->integer('st_resum')->nullable();
            $table->integer('st_alergi')->nullable();
            $table->text('ttd')->nullable();
            $table->integer('ft_kartu_keluarga')->nullable();
            $table->integer('ft_ktp')->nullable();
            $table->string('umur_wali', 50)->nullable();
            $table->string('jen_kel_wali', 50)->nullable();
            $table->integer('ft_kartu')->nullable();
            $table->string('prolanisPRB', 150)->nullable();

            $table->primary(['no_mr'], 'pk_mt_master_pasien_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_pasien');
    }
};
