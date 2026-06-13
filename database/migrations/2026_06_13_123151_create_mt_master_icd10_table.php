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
        Schema::create('mt_master_icd10', function (Blueprint $table) {
            $table->string('icd_10', 10);
            $table->string('kd_asteric', 10)->nullable();
            $table->string('kel', 10)->nullable();
            $table->smallInteger('no_urut_dtd')->nullable();
            $table->string('nama_icd')->nullable();
            $table->string('group_id', 10)->nullable();
            $table->string('icd_rl', 10)->nullable();
            $table->string('field5')->nullable();
            $table->string('field6')->nullable();
            $table->float('field7', 53, 0)->nullable();
            $table->float('field8', 53, 0)->nullable();
            $table->string('field9')->nullable();
            $table->string('field10')->nullable();
            $table->string('field11')->nullable();
            $table->string('field12')->nullable();
            $table->string('field14')->nullable();
            $table->string('icd_10_ok')->nullable();
            $table->integer('flag_upd')->nullable();

            $table->primary(['icd_10'], 'pk_mt_master_icd10');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_master_icd10');
    }
};
