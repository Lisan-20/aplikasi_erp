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
        if (Schema::hasTable('tc_obat_ruangan')) {
            return;
        }

        Schema::create('tc_obat_ruangan', function (Blueprint $table) {
            $table->bigIncrements('id_tc_obat_ruangan');
            $table->bigInteger('kode_trans_pelayanan')->nullable();
            $table->string('kode_brg', 20)->nullable();
            $table->decimal('jumlah', 19, 4)->nullable();
            $table->decimal('harga_jual', 19, 4)->nullable();
            $table->decimal('harga_beli', 19, 4)->nullable();
            $table->integer('status')->nullable();
            $table->string('no_input', 50)->nullable();
            $table->integer('status_input')->nullable();
            $table->decimal('profit_2_persen', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_obat_ruangan');
    }
};
