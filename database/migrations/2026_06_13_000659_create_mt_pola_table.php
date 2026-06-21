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
        if (Schema::hasTable('mt_pola')) {
            return;
        }

        Schema::create('mt_pola', function (Blueprint $table) {
            $table->string('acc_pola', 10);
            $table->string('nama_pola')->nullable();
            $table->string('jenis_tindakan')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->string('pelayanan')->nullable();
            $table->string('lab')->nullable();
            $table->string('rehab_medik')->nullable();
            $table->string('obat')->nullable();
            $table->string('tarif_dr')->nullable();
            $table->string('discon')->nullable();
            $table->decimal('diskon_number', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_pola');
    }
};
