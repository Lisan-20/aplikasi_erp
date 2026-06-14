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
        if (Schema::hasTable('mt_icd_diagnosa')) {
            return;
        }

        Schema::create('mt_icd_diagnosa', function (Blueprint $table) {
            $table->increments('id_mt_icd_diagnosa');
            $table->integer('kode_icd_diagnosa');
            $table->string('kode_icd')->nullable();
            $table->string('nama_diagnosa')->nullable();
            $table->string('kode_bagian')->nullable();
            $table->integer('flag_diag')->nullable();

            $table->primary(['kode_icd_diagnosa'], 'pk_mt_icd_diagnosa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_icd_diagnosa');
    }
};
