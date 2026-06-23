<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mt_erp_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('mt_erp_kecamatan')->onDelete('cascade');
            $table->string('kode_kelurahan', 15)->unique();
            $table->string('nama_kelurahan', 100);
            $table->string('kodepos', 10)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mt_erp_kelurahan');
    }
};
