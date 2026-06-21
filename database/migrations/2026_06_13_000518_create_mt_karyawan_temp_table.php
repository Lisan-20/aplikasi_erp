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
        if (Schema::hasTable('mt_karyawan_temp')) {
            return;
        }

        Schema::create('mt_karyawan_temp', function (Blueprint $table) {
            $table->increments('no_induk');
            $table->integer('urutan_karyawan')->nullable();
            $table->string('nama_pegawai', 50)->nullable();
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
            $table->string('tmp_lahir', 150)->nullable();
            $table->string('tlp', 150)->nullable();
            $table->integer('id_sex')->nullable();
            $table->integer('id_status')->nullable();
            $table->integer('id_dc_kawin')->nullable();
            $table->decimal('gaji_pokok', 19, 4)->nullable();
            $table->string('npp', 20)->nullable();
            $table->string('nama_bank', 150)->nullable();
            $table->string('no_rekening', 20)->nullable();
            $table->string('bank_cabang', 150)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_bagian_gaji', 50)->nullable();
            $table->integer('id_dc_agama')->nullable();
            $table->dateTime('tmt_bekerja')->nullable();
            $table->string('nama_ibu', 150)->nullable();
            $table->float('tinggi_Badan', null, 0)->nullable();
            $table->float('berat_badan', null, 0)->nullable();
            $table->string('gol_darah', 50)->nullable();
            $table->string('suku', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->string('no_str', 50)->nullable();
            $table->string('no_sip', 50)->nullable();
            $table->dateTime('tgl_berlaku')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->text('registrasi')->nullable();
            $table->dateTime('tgl_ttd')->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_mulai')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->integer('kodeDPJP')->nullable();
            $table->integer('flag_poli')->nullable();
            $table->integer('kode_dokter_hfis')->nullable();
            $table->text('ttd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_karyawan_temp');
    }
};
