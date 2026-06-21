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
        if (Schema::hasTable('tc_penerimaan_gizi')) {
            return;
        }

        Schema::create('tc_penerimaan_gizi', function (Blueprint $table) {
            $table->string('kode_penerimaan', 20);
            $table->string('kode_permohonan', 20)->nullable();
            $table->dateTime('tgl_penerimaan')->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('petugas', 20)->nullable();
            $table->integer('tipe_lpb')->nullable()->default(0);
            $table->string('keterangan')->nullable();
            $table->string('no_kuitansi', 20)->nullable();
            $table->string('diketahui', 20)->nullable();
            $table->string('dikirim', 20)->nullable();
            $table->string('disetujui', 20)->nullable();
            $table->integer('status_invoice')->nullable()->default(0);
            $table->tinyInteger('flag_hutang')->nullable();
            $table->tinyInteger('flag_jurnal')->nullable();
            $table->integer('id_tc_penerimaan_brg_nm');
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->integer('id_trans_umd')->nullable();

            $table->primary(['kode_penerimaan'], 'pk_tc_penerimaan_gizi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_gizi');
    }
};
