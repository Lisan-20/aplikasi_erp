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
        if (Schema::hasTable('mt_master_tarif')) {
            return;
        }

        Schema::create('mt_master_tarif', function (Blueprint $table) {
            $table->integer('kode_tarif');
            $table->string('nama_tarif');
            $table->integer('tingkatan');
            $table->string('ket')->nullable();
            $table->string('kode_bagian', 18);
            $table->integer('referensi')->nullable();
            $table->tinyInteger('jenis_tindakan')->nullable();
            $table->integer('paket_askes')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_grup_tindakan')->nullable();
            $table->integer('paket_mcu')->nullable();
            $table->char('rl_lab', 10)->nullable();
            $table->integer('flag_rujukan')->nullable();
            $table->integer('flag_insentif')->nullable();
            $table->integer('flag_reg')->nullable();
            $table->integer('flag_paket')->nullable();
            $table->integer('fee_dr')->nullable();
            $table->integer('flag_buku')->nullable();
            $table->integer('flag_bdpoli')->nullable();
            $table->string('kode_tindakan', 20)->nullable();
            $table->integer('flag_alat')->nullable();
            $table->integer('flag_listrik')->nullable();
            $table->integer('flag_aktif')->nullable();
            $table->decimal('nominal_insentif', 19, 4)->nullable();
            $table->integer('flag_dr')->nullable();
            $table->integer('kelompok_eklaim')->nullable();

            $table->primary(['kode_tarif'], 'pk_mt_master_tarif_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif');
    }
};
