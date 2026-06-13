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
        Schema::create('mt_plafon_bpjs_detail', function (Blueprint $table) {
            $table->increments('kode_plafon_det');
            $table->integer('kode_plafon')->nullable();
            $table->integer('jenis_tindakan')->nullable();
            $table->decimal('persen', 18)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->decimal('bill_rs_jatah', 19, 4)->nullable();
            $table->decimal('bill_dr1_jatah', 19, 4)->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('id_jenis_layanan')->nullable();
            $table->decimal('persen_dr', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_plafon_bpjs_detail');
    }
};
