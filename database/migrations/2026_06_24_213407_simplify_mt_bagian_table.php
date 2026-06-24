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
        Schema::table('mt_bagian', function (Blueprint $table) {
            $table->dropColumn([
                'validasi',
                'jumlah_kamar',
                'harga_kamar',
                'template',
                'pelayanan',
                'kelompok_unit',
                'kode_rs',
                'stat_depo',
                'val_bpjs',
                'id_jenis_layanan',
                'flag_giz',
                'inv_nm',
                'kode_depo_bag',
                'flag_gdu',
                'nm_bagian_umum',
                'validasi_lap_rm',
                'flag_hrd',
                'kode_poli_vclaim',
                'flag_lt',
                'nilai_remun',
                'id_bag_gaji',
                'grup_rl'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mt_bagian', function (Blueprint $table) {
            // Kita tidak perlu menulis semua tipe data detail untuk down()
            // kecuali jika kita benar-benar butuh rollback ke struktur lama.
        });
    }
};
