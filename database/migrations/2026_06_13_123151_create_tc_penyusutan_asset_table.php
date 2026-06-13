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
        if (Schema::hasTable('tc_penyusutan_asset')) {
            return;
        }

        Schema::create('tc_penyusutan_asset', function (Blueprint $table) {
            $table->increments('id_tc_penyusutan_asset');
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
            $table->string('kode_barang', 15)->nullable();
            $table->string('kode_bagian', 15)->nullable();
            $table->integer('asset_type')->nullable();
            $table->decimal('nominal_penyusutan', 19, 4)->nullable();
            $table->string('acc_d', 10)->nullable();
            $table->integer('no_induk')->nullable();
            $table->string('acc_k', 10)->nullable();
            $table->integer('flag_jurnal')->nullable();
            $table->decimal('qty', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penyusutan_asset');
    }
};
