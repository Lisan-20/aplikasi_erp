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
        Schema::create('tc_sep_ri_temp_bak', function (Blueprint $table) {
            $table->integer('no')->nullable();
            $table->string('tgl_masuk', 100)->nullable();
            $table->string('tgl_pulang', 100)->nullable();
            $table->string('no_mr', 10)->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->string('no_sep', 100)->nullable();
            $table->string('kode_cbg', 50)->nullable();
            $table->string('topup', 100)->nullable();
            $table->integer('total_tarif')->nullable();
            $table->integer('tarif_rs')->nullable();
            $table->string('jenis', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_sep_ri_temp_bak');
    }
};
