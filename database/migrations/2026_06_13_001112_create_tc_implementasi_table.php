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
        if (Schema::hasTable('tc_implementasi')) {
            return;
        }

        Schema::create('tc_implementasi', function (Blueprint $table) {
            $table->increments('id_imp');
            $table->integer('kode_rm')->nullable();
            $table->dateTime('tgl_imp')->nullable();
            $table->integer('id_user')->nullable();
            $table->dateTime('tgl_ttd')->nullable();
            $table->text('ttd')->nullable();
            $table->string('ttd_nama', 50)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->text('evaluasi')->nullable();
            $table->integer('kode_rm_inp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_implementasi');
    }
};
