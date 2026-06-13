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
        if (Schema::hasTable('tc_bayar_tagih_det')) {
            return;
        }

        Schema::create('tc_bayar_tagih_det', function (Blueprint $table) {
            $table->increments('id_tc_bayar_tagih_det');
            $table->integer('id_tc_bayar_tagih')->nullable();
            $table->integer('id_tc_tagih_det')->nullable();
            $table->decimal('jumlah_bayar', 19, 4)->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('status_ver')->nullable();
            $table->decimal('diskon_bayar', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_bayar_tagih_det');
    }
};
