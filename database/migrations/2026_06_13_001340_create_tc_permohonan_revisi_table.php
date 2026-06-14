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
        if (Schema::hasTable('tc_permohonan_revisi')) {
            return;
        }

        Schema::create('tc_permohonan_revisi', function (Blueprint $table) {
            $table->string('kode_rev', 18);
            $table->string('kode_brg', 20)->nullable();
            $table->integer('qty_kecil')->nullable();
            $table->integer('jumlah_harga')->nullable();
            $table->integer('content')->nullable();
            $table->integer('qty_besar')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('flag_instansi')->nullable();
            $table->integer('nomor_permohonan')->nullable();

            $table->primary(['kode_rev'], 'pk__tc_permohonan_re__637a7270');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permohonan_revisi');
    }
};
