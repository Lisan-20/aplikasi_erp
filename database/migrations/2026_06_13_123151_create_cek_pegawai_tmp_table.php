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
        Schema::create('cek_pegawai_tmp', function (Blueprint $table) {
            $table->increments('no_induk');
            $table->integer('urutan_karyawan')->nullable();
            $table->text('nama_pegawai')->nullable();
            $table->integer('kode_jabatan')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->integer('kode_spesialisasi')->nullable();
            $table->integer('status_dr')->nullable();
            $table->string('status', 20)->nullable();
            $table->integer('available')->nullable();
            $table->string('jatah_kelas', 50)->nullable();
            $table->integer('level_id')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('flag_anes')->nullable();
            $table->integer('flag_aktif')->nullable();
            $table->dateTime('tgl_lahir')->nullable();
            $table->string('tmp_lahir', 50)->nullable();
            $table->string('tlp', 50)->nullable();
            $table->integer('id_sex')->nullable();
            $table->integer('id_status')->nullable();
            $table->integer('id_dc_kawin')->nullable();
            $table->decimal('gaji_pokok', 19, 4)->nullable();
            $table->string('nama_bank', 20)->nullable();
            $table->string('no_rekening', 20)->nullable();
            $table->string('bank_cabang', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_bagian_gaji', 50)->nullable();
            $table->integer('id_dc_agama')->nullable();
            $table->dateTime('tmt_bekerja')->nullable();
            $table->float('tinggi_Badan', null, 0)->nullable();
            $table->float('berat_badan', null, 0)->nullable();
            $table->string('gol_darah', 50)->nullable();
            $table->string('suku', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->text('nama_panggilan')->nullable();
            $table->string('no_ktp', 50)->nullable();
            $table->string('no_sim', 50)->nullable();
            $table->string('ketenagakerjaan_1', 50)->nullable();
            $table->char('ketenagakerjaan_2', 10)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->dateTime('tgl_akhir_ktp')->nullable();
            $table->string('ko_wil', 5)->nullable();
            $table->integer('level_pegawai')->nullable();
            $table->integer('kode_paramedis')->nullable();
            $table->integer('flag_paramedis')->nullable();
            $table->integer('no_finger')->nullable();
            $table->bigInteger('npp')->nullable();
            $table->decimal('gf_dokter', 18)->nullable();
            $table->string('ket_gf_dokter', 250)->nullable();
            $table->string('kd', 50)->nullable();
            $table->integer('jml_sittiing')->nullable();
            $table->decimal('nominal_fee', 19, 4)->nullable();
            $table->integer('flag_sitDay')->nullable();
            $table->integer('flag_sitMonth')->nullable();
            $table->integer('wajib_absen')->nullable();
            $table->decimal('insentif_dr', 19, 4)->nullable();
            $table->string('ketenagakerjaan_3', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_pegawai_tmp');
    }
};
