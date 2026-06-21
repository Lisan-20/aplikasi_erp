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
        if (Schema::hasTable('gd_fr_tc_gudang')) {
            return;
        }

        Schema::create('gd_fr_tc_gudang', function (Blueprint $table) {
            $table->integer('kode_trans_gudang');
            $table->integer('kode_form_rs')->nullable();
            $table->string('no_kirim', 50)->nullable();
            $table->integer('kode_profit')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->dateTime('tgl_trans')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('status_transaksi')->nullable();
            $table->integer('petugas')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->integer('user_ver')->nullable();

            $table->primary(['kode_trans_gudang'], 'pk_gd_fr_tc_gudang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_fr_tc_gudang');
    }
};
