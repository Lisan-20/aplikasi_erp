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
        if (Schema::hasTable('mt_emr_det')) {
            return;
        }

        Schema::create('mt_emr_det', function (Blueprint $table) {
            $table->increments('no_urut')->index('ix_no_urut');
            $table->string('kode_bagian', 50)->nullable()->index('ix_kode_bagian');
            $table->integer('kode_rm')->nullable();
            $table->integer('no_urut_form')->nullable()->index('ix_no_urut_form');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_emr_det');
    }
};
