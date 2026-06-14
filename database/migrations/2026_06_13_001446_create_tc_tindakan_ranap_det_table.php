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
        if (Schema::hasTable('tc_tindakan_ranap_det')) {
            return;
        }

        Schema::create('tc_tindakan_ranap_det', function (Blueprint $table) {
            $table->increments('id_tc_tindakan_ranap_det');
            $table->text('no_mr')->nullable();
            $table->integer('no_reg')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->text('tindakan')->nullable();
            $table->dateTime('tgl_jam')->nullable();
            $table->text('id_perawat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_tindakan_ranap_det');
    }
};
