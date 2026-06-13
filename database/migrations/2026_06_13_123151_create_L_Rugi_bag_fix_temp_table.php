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
        Schema::create('L_Rugi_bag_fix_temp', function (Blueprint $table) {
            $table->integer('acc_no')->nullable();
            $table->string('acc_nama', 100)->nullable();
            $table->integer('vol')->nullable();
            $table->decimal('rupiah', 18)->nullable();
            $table->decimal('ratio', 18)->nullable();
            $table->integer('vol_ll')->nullable();
            $table->decimal('rupiah_ll', 18)->nullable();
            $table->decimal('ratio_ll', 18)->nullable();
            $table->integer('vol_sel')->nullable();
            $table->decimal('rupiah_sel', 18)->nullable();
            $table->decimal('ratio_sel', 18)->nullable();
            $table->decimal('evektif_sel', 18)->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('tx_tipe', 1)->nullable();
            $table->integer('referensi')->nullable();
            $table->string('kode_bagian', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('L_Rugi_bag_fix_temp');
    }
};
