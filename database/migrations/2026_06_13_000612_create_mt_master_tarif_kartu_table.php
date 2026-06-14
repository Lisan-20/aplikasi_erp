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
        if (Schema::hasTable('mt_master_tarif_kartu')) {
            return;
        }

        Schema::create('mt_master_tarif_kartu', function (Blueprint $table) {
            $table->increments('kode_tarif_kartu');
            $table->string('nama_tarif', 50)->nullable();
            $table->decimal('bill_rs', 19, 4)->nullable();
            $table->tinyInteger('kode_tgl_tarif')->nullable();

            $table->primary(['kode_tarif_kartu'], 'pk_mt_master_tarif_kartu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_tarif_kartu');
    }
};
