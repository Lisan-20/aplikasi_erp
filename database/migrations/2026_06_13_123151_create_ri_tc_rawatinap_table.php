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
        Schema::create('ri_tc_rawatinap', function (Blueprint $table) {
            $table->increments('kode_ri');
            $table->integer('no_kunjungan');
            $table->string('kode_ruangan', 50)->nullable();
            $table->string('bag_pas', 50)->nullable();
            $table->integer('kelas_pas')->nullable()->default(0);
            $table->integer('jatah_klas')->nullable()->default(0);
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->string('dr_merawat', 50)->nullable();
            $table->text('asal_pasien')->nullable();
            $table->text('penjamin')->nullable();
            $table->text('surat_jaminan')->nullable();
            $table->text('alm_penjamin')->nullable();
            $table->string('telp_penjamin', 25)->nullable();
            $table->decimal('nilai_deposit', 19, 4)->nullable();
            $table->string('mr_ibu', 50)->nullable();
            $table->string('bag_ibu', 50)->nullable();
            $table->integer('kelas_ibu')->nullable();
            $table->tinyInteger('status_pulang')->nullable()->default(0);
            $table->string('user_dtg', 10)->nullable();
            $table->string('user_plg', 10)->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status_cuti')->nullable()->default(0)->comment('cuti:1 selain itu 0');
            $table->decimal('plafon_bpjs', 19, 4)->nullable();
            $table->string('diagnosa_awal')->nullable();
            $table->string('no_jkn')->nullable();
            $table->string('icd10')->nullable();
            $table->string('icd9')->nullable();
            $table->integer('kode_plafon')->nullable();
            $table->integer('status_batal')->nullable();
            $table->text('catatan')->nullable();
            $table->text('rencana_pulang')->nullable();
            $table->dateTime('input_pulang')->nullable();
            $table->decimal('alos', 18)->nullable();
            $table->integer('kode_inap')->nullable();
            $table->integer('flag_dr_ri_perujuk')->nullable();
            $table->string('code_inacbg', 100)->nullable();
            $table->string('kode_ruangan_ttp', 50)->nullable();
            $table->integer('dr_merujuk')->nullable();

            $table->primary(['kode_ri'], 'pk_ri_tc_rawatinap_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_tc_rawatinap');
    }
};
