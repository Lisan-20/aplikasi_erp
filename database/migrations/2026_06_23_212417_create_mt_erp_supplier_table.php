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
        Schema::create('mt_erp_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('kode_supplier', 50)->unique();
            $table->string('nama_supplier', 150);
            $table->text('alamat')->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kodepos', 20)->nullable();
            $table->string('telepon_1', 30)->nullable();
            $table->string('telepon_2', 30)->nullable();
            $table->string('kontak_person', 100)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('izin_usaha', 100)->nullable();
            $table->string('nama_bank', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_erp_supplier');
    }
};
