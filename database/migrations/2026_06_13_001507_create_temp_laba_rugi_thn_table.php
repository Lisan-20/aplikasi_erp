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
        if (Schema::hasTable('temp_laba_rugi_thn')) {
            return;
        }

        Schema::create('temp_laba_rugi_thn', function (Blueprint $table) {
            $table->increments('id_pab');
            $table->string('acc_no_lr', 50)->nullable();
            $table->string('acc_nama_lr', 150)->nullable();
            $table->string('kode_utama', 50)->nullable();
            $table->integer('thn')->nullable();
            $table->decimal('jan', 18)->nullable();
            $table->decimal('peb', 18)->nullable();
            $table->decimal('mar', 18)->nullable();
            $table->decimal('apr', 18)->nullable();
            $table->decimal('mei', 18)->nullable();
            $table->decimal('jun', 18)->nullable();
            $table->decimal('jul', 18)->nullable();
            $table->decimal('agt', 18)->nullable();
            $table->decimal('sep', 18)->nullable();
            $table->decimal('okt', 18)->nullable();
            $table->decimal('nop', 18)->nullable();
            $table->decimal('des', 18)->nullable();
            $table->string('acc_type', 50)->nullable();
            $table->string('kode_golongan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_laba_rugi_thn');
    }
};
