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
        if (Schema::hasTable('tbl_tarif_detail_obat')) {
            return;
        }

        Schema::create('tbl_tarif_detail_obat', function (Blueprint $table) {
            $table->integer('id_tarif_obat');
            $table->string('kode_brg_paket', 50)->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->integer('jumlah')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tarif_detail_obat');
    }
};
