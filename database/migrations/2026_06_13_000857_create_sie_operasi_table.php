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
        if (Schema::hasTable('sie_operasi')) {
            return;
        }

        Schema::create('sie_operasi', function (Blueprint $table) {
            $table->increments('id_operasi');
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('kode_kelas')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('jenis_operasi')->nullable();
            $table->integer('jml_operasi')->nullable();
            $table->integer('kode_perusahaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sie_operasi');
    }
};
