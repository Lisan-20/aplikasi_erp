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
        if (Schema::hasTable('tc_cppt_transfusi_detail2')) {
            return;
        }

        Schema::create('tc_cppt_transfusi_detail2', function (Blueprint $table) {
            $table->integer('Id')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('tanda_vital', 250)->nullable();
            $table->string('tekan_darah', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('suhu', 50)->nullable();
            $table->string('pernafasan', 50)->nullable();
            $table->integer('transfusi_ke')->nullable();
            $table->text('reaksi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cppt_transfusi_detail2');
    }
};
