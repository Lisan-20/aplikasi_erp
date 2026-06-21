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
        if (Schema::hasTable('tarif_honordr_bpjs')) {
            return;
        }

        Schema::create('tarif_honordr_bpjs', function (Blueprint $table) {
            $table->float('kode_kls', 53, 0)->nullable();
            $table->float('kode_tarif', 53, 0)->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->string('total')->nullable();
            $table->float('dr', 53, 0)->nullable();
            $table->string('rs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_honordr_bpjs');
    }
};
