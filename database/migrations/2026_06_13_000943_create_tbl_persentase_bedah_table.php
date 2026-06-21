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
        if (Schema::hasTable('tbl_persentase_bedah')) {
            return;
        }

        Schema::create('tbl_persentase_bedah', function (Blueprint $table) {
            $table->increments('id_tbl_persen');
            $table->integer('kode_plafon')->nullable();
            $table->integer('kode_spesialisasi')->nullable();
            $table->decimal('persen_dr', 18)->nullable();
            $table->integer('id_jenis_layanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_persentase_bedah');
    }
};
