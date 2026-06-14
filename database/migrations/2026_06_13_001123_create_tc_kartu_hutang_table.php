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
        if (Schema::hasTable('tc_kartu_hutang')) {
            return;
        }

        Schema::create('tc_kartu_hutang', function (Blueprint $table) {
            $table->increments('id_tc_kartu_hutang');
            $table->dateTime('tgl_kartu')->nullable();
            $table->string('no_bukti', 50)->nullable();
            $table->integer('kodesupplier')->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->string('keterangan')->nullable();
            $table->decimal('saldo_awal', 19, 4)->nullable()->default(0);
            $table->decimal('debet', 19, 4)->nullable()->default(0);
            $table->decimal('kredit', 19, 4)->nullable()->default(0);
            $table->decimal('saldo_akhir', 19, 4)->nullable()->default(0);
            $table->dateTime('tgl_input')->nullable();
            $table->integer('input_id')->nullable();

            $table->primary(['id_tc_kartu_hutang'], 'pk_tc_kartu_hutang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kartu_hutang');
    }
};
