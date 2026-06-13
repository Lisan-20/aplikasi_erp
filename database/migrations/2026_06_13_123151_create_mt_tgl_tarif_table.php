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
        Schema::create('mt_tgl_tarif', function (Blueprint $table) {
            $table->integer('kode_tgl_tarif');
            $table->string('nomor_sk', 20)->nullable();
            $table->dateTime('tgl_berlaku')->nullable();
            $table->integer('status')->nullable();

            $table->primary(['kode_tgl_tarif'], 'pk__mt_tgl_tarif__521adc44');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_tgl_tarif');
    }
};
