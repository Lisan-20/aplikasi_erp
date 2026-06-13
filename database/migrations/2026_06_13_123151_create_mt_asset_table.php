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
        Schema::create('mt_asset', function (Blueprint $table) {
            $table->increments('id_asset');
            $table->string('kode_brg', 20)->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->string('asset_type', 10)->nullable();
            $table->dateTime('tgl_perolehan')->nullable();
            $table->dateTime('tgl_pemakaian')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('estimasi_penggunaan')->nullable();
            $table->integer('metode_penyusutan')->nullable();
            $table->decimal('rate', 19, 4)->nullable();
            $table->decimal('residu', 19, 4)->nullable();
            $table->string('no_asset', 20)->nullable();
            $table->integer('status_asset')->nullable();
            $table->dateTime('tgl_kadaluarsa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_asset');
    }
};
