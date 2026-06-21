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
        if (Schema::hasTable('mt_emr_poli_temp')) {
            return;
        }

        Schema::create('mt_emr_poli_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_urut')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->integer('no_urut_form')->nullable();
            $table->string('nama_form', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('url_cetakan', 250)->nullable();
            $table->integer('kode_rm');
            $table->string('url_edit', 250)->nullable();
            $table->string('url_cetakan_his', 250)->nullable();
            $table->integer('flg_dr')->nullable();
            $table->string('url_implementasi', 250)->nullable();
            $table->string('url_edit_his', 250)->nullable();
            $table->integer('flag_dr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_emr_poli_temp');
    }
};
