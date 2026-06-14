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
        if (Schema::hasTable('mt_diag_awal_bpjs')) {
            return;
        }

        Schema::create('mt_diag_awal_bpjs', function (Blueprint $table) {
            $table->string('Code', 10)->nullable();
            $table->text('Deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_diag_awal_bpjs');
    }
};
