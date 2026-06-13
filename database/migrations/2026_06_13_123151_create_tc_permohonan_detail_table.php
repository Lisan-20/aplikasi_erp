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
        if (Schema::hasTable('tc_permohonan_detail')) {
            return;
        }

        Schema::create('tc_permohonan_detail', function (Blueprint $table) {
            $table->string('no_urut_detail', 18);
            $table->integer('status_po')->nullable();
            $table->integer('rasio')->nullable();
            $table->string('satuan_besar', 20)->nullable();
            $table->integer('jumlah_besar')->nullable();
            $table->integer('nomor_permohonan')->nullable();
            $table->string('kode_brg', 20)->nullable();

            $table->primary(['no_urut_detail'], 'pk__tc_permohonan_de__619229fe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permohonan_detail');
    }
};
