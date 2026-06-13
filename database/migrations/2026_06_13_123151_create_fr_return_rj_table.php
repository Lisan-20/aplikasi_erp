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
        Schema::create('fr_return_rj', function (Blueprint $table) {
            $table->increments('id_fr_return_rj');
            $table->integer('kode_tc_trans_kasir')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_pasien')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kuitansi')->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->string('nama_bagian', 40)->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->string('nama_brg')->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('servis', 19, 4)->nullable();
            $table->tinyInteger('status_refund')->nullable();

            $table->primary(['id_fr_return_rj'], 'pk_fr_return_rj');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_return_rj');
    }
};
