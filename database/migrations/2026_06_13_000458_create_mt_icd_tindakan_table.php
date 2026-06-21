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
        if (Schema::hasTable('mt_icd_tindakan')) {
            return;
        }

        Schema::create('mt_icd_tindakan', function (Blueprint $table) {
            $table->increments('id_mt_icd_tindakan');
            $table->integer('kode_icd_tindakan');
            $table->string('kode_icd')->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->string('kode_bagian')->nullable();
            $table->integer('flag_tind')->nullable();

            $table->primary(['kode_icd_tindakan'], 'pk_mt_icd_tindakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_icd_tindakan');
    }
};
