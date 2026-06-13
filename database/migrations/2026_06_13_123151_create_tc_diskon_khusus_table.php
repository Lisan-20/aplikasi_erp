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
        Schema::create('tc_diskon_khusus', function (Blueprint $table) {
            $table->integer('id_tc_diskon');
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 10)->nullable();
            $table->decimal('jumlah_diskon', 19, 4)->nullable();
            $table->text('alasan')->nullable();
            $table->integer('verifikator')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->bigInteger('kode_trans_far')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_diskon_khusus');
    }
};
