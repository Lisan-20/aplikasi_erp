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
        Schema::create('tb_dashboard', function (Blueprint $table) {
            $table->integer('no')->nullable();
            $table->string('kelas_dan_ruang', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('kode_klas', 1)->nullable();
            $table->string('kode_klas_bpjs', 50)->nullable();
            $table->string('logo', 150)->nullable();
            $table->integer('jml_bed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_dashboard');
    }
};
