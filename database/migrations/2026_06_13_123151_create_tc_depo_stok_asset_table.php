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
        Schema::create('tc_depo_stok_asset', function (Blueprint $table) {
            $table->increments('kode_depo_stok_asset');
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->decimal('jumlah', 18)->nullable();
            $table->dateTime('tgl_perolehan')->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
            $table->dateTime('tgl_pemakaian')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('estimasi_penggunaan')->nullable();
            $table->integer('metode_penyusutan')->nullable();
            $table->decimal('rate', 19, 4)->nullable();
            $table->decimal('nilai_residu', 19, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_depo_stok_asset');
    }
};
