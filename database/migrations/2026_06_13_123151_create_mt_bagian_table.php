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
        if (Schema::hasTable('mt_bagian')) {
            return;
        }

        Schema::create('mt_bagian', function (Blueprint $table) {
            $table->increments('id_mt_bagian');
            $table->string('kode_bagian', 18);
            $table->string('nama_bagian', 40)->nullable();
            $table->string('group_bag', 10)->nullable();
            $table->string('validasi', 50)->nullable();
            $table->integer('jumlah_kamar')->nullable();
            $table->decimal('harga_kamar', 15)->nullable();
            $table->string('template')->nullable();
            $table->integer('pelayanan')->nullable();
            $table->integer('kelompok_unit')->nullable();
            $table->tinyInteger('status_aktif')->nullable();
            $table->string('kode_rs', 2)->nullable();
            $table->integer('stat_depo')->nullable();
            $table->string('val_bpjs', 18)->nullable();
            $table->integer('id_jenis_layanan')->nullable();
            $table->string('inisial', 10)->nullable();
            $table->integer('flag_giz')->nullable();
            $table->integer('inv_nm')->nullable();
            $table->string('kode_depo_bag', 50)->nullable();
            $table->integer('flag_gdu')->nullable();
            $table->string('nm_bagian_umum', 100)->nullable();
            $table->string('acc_ref', 18)->nullable();
            $table->string('acc_ref_biaya', 18)->nullable();
            $table->string('validasi_lap_rm', 50)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('color', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->integer('flag_hrd')->nullable();
            $table->string('kode_poli_vclaim', 50)->nullable();
            $table->integer('flag_lt')->nullable();
            $table->integer('grup_rl')->nullable();

            $table->primary(['kode_bagian'], 'pk_mt_bagian_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_bagian');
    }
};
