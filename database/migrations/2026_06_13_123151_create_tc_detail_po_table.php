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
        Schema::create('tc_detail_po', function (Blueprint $table) {
            $table->string('kode_detail_po', 18);
            $table->string('kode_brg', 20)->nullable();
            $table->integer('no_po')->nullable();
            $table->integer('jumlah_besar')->nullable();
            $table->integer('content')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('harga_satuan_netto')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('bonus_besar')->nullable();
            $table->integer('bonus_kecil')->nullable();
            $table->integer('no_pp')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('status_close')->nullable();

            $table->primary(['kode_detail_po'], 'pk__tc_detail_po__69334bc6');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_detail_po');
    }
};
