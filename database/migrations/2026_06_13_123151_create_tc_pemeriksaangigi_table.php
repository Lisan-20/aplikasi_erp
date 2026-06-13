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
        if (Schema::hasTable('tc_pemeriksaangigi')) {
            return;
        }

        Schema::create('tc_pemeriksaangigi', function (Blueprint $table) {
            $table->integer('kode_tc_pemeriksaangigi');
            $table->string('kode_pemeriksaan', 50)->nullable()->index('ix_kode_pemeriksaan');
            $table->string('hasil', 50)->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('kode_grup_tindakan')->nullable();
            $table->string('no_kunjungan', 50)->nullable()->index('ix_no_kunjungan');
            $table->integer('id_mt_fisik_det')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('id_mt_kesimpulan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaangigi');
    }
};
