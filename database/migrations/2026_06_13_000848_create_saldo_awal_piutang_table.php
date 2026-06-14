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
        if (Schema::hasTable('saldo_awal_piutang')) {
            return;
        }

        Schema::create('saldo_awal_piutang', function (Blueprint $table) {
            $table->increments('kd_saldo_awal_piutang');
            $table->integer('kd_piutang')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_saldo_awal')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->dateTime('tgl_jt')->nullable();
            $table->decimal('saldo_awal', 15)->nullable();
            $table->string('keterangan')->nullable();
            $table->tinyInteger('askes')->nullable();
            $table->smallInteger('flag_proses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_awal_piutang');
    }
};
