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
        Schema::create('tbl_persentase_tarif', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_milik')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('persentase')->nullable();
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_persentase_tarif');
    }
};
