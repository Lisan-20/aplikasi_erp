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
        Schema::create('mt_plafon_dokter_det', function (Blueprint $table) {
            $table->increments('id_plafon_dr_bpjs');
            $table->string('katagori', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->string('detail', 50)->nullable();
            $table->decimal('persen', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_plafon_dokter_det');
    }
};
