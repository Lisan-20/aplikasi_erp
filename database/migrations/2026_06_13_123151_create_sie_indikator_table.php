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
        Schema::create('sie_indikator', function (Blueprint $table) {
            $table->increments('id_indikator');
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kode_kelas')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('jml_masuk')->nullable();
            $table->integer('jml_keluar')->nullable();
            $table->integer('jml_hari_rawat')->nullable();
            $table->integer('jml_tt_tidur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sie_indikator');
    }
};
