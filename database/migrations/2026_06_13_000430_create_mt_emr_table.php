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
        if (Schema::hasTable('mt_emr')) {
            return;
        }

        Schema::create('mt_emr', function (Blueprint $table) {
            $table->increments('kode_rm')->index('ix_kode_rm');
            $table->string('nama_form', 250)->nullable()->index('ix_nama_form');
            $table->string('url', 250)->nullable();
            $table->string('icon', 50)->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('url_cetakan', 250)->nullable();
            $table->string('url_edit', 250)->nullable();
            $table->string('url_cetakan_his', 250)->nullable();
            $table->string('url_implementasi', 250)->nullable();
            $table->integer('flag_penunjang')->nullable();

            $table->primary(['kode_rm'], 'pk_mt_emr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_emr');
    }
};
