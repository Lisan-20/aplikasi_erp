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
        if (Schema::hasTable('mt_plafon_bpjs')) {
            return;
        }

        Schema::create('mt_plafon_bpjs', function (Blueprint $table) {
            $table->integer('kode_plafon');
            $table->string('nama_plafon')->nullable();
            $table->decimal('jumlah_plafon', 19, 4)->nullable();
            $table->string('kode_icd')->nullable();

            $table->primary(['kode_plafon'], 'pk_mt_plafon_bpjs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_plafon_bpjs');
    }
};
