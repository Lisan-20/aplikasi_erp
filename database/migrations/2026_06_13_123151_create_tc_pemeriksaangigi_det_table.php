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
        if (Schema::hasTable('tc_pemeriksaangigi_det')) {
            return;
        }

        Schema::create('tc_pemeriksaangigi_det', function (Blueprint $table) {
            $table->integer('kd_tc_pemeriksaangigi_det');
            $table->integer('id_mt_fisik_det')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('id_mt_kesimpulan')->nullable();
            $table->integer('id_mt_saran')->nullable();
            $table->integer('no_kunjungan')->nullable()->index('ix_no_kunjungan');
            $table->integer('kode_pemeriksaan')->nullable()->index('ix_kode_pemeriksaan');
            $table->integer('kode_grup_tindakan')->nullable();
            $table->integer('kode_tc_pemeriksaangigi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaangigi_det');
    }
};
