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
        Schema::create('fr_mt_paket_komposisi', function (Blueprint $table) {
            $table->increments('id_mt_paket_komposisi');
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_brg_komposisi', 20)->nullable();
            $table->decimal('jumlah_komposisi', 18, 0)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('petugas_input')->nullable();
            $table->integer('status_edit')->nullable();
            $table->integer('status_aktif')->nullable();

            $table->primary(['id_mt_paket_komposisi'], 'pk_fr_mt_paket_komposisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_mt_paket_komposisi');
    }
};
