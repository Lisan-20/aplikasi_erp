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
        Schema::create('mt_klasifikasi_insentif', function (Blueprint $table) {
            $table->increments('id_mt_klasifikasi_insentif');
            $table->integer('kode_klasifikasi')->nullable();
            $table->string('nama_klasifikasi')->nullable();
            $table->decimal('plafon', 19, 4)->nullable();
            $table->integer('id_mt_kategori_ins_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_klasifikasi_insentif');
    }
};
