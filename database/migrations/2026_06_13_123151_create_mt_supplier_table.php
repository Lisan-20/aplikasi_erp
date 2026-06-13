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
        if (Schema::hasTable('mt_supplier')) {
            return;
        }

        Schema::create('mt_supplier', function (Blueprint $table) {
            $table->increments('id_mt_supplier');
            $table->integer('kodesupplier');
            $table->string('namasupplier', 100)->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota', 100)->nullable();
            $table->integer('id_dc_kota')->nullable();
            $table->string('kodepos', 6)->nullable();
            $table->integer('id_dc_propinsi')->nullable();
            $table->string('telpon1', 25)->nullable();
            $table->string('telpon2', 25)->nullable();
            $table->string('kontakperson', 50)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('ijinpbf', 50)->nullable();
            $table->string('namabank')->nullable();
            $table->decimal('plafon', 19, 4)->nullable();
            $table->string('pola_supplier', 50)->nullable();
            $table->integer('flag_gizi')->nullable();
            $table->integer('flag_sup')->nullable();
            $table->integer('status_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_supplier');
    }
};
