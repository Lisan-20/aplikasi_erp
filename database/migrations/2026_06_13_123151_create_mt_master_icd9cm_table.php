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
        Schema::create('mt_master_icd9cm', function (Blueprint $table) {
            $table->increments('id_icd_9');
            $table->string('icd_9', 10);
            $table->string('nama_icd')->nullable();
            $table->string('icd_9_tampil', 10)->nullable();

            $table->primary(['icd_9'], 'pk_mt_master_icd9cm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_icd9cm');
    }
};
