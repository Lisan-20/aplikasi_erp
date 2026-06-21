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
        if (Schema::hasTable('rg_tc_rujukan')) {
            return;
        }

        Schema::create('rg_tc_rujukan', function (Blueprint $table) {
            $table->integer('kode_rujukan');
            $table->string('rujukan_dari', 18);
            $table->string('no_mr', 8);
            $table->integer('no_kunjungan_lama');
            $table->integer('no_registrasi');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->dateTime('tgl_input')->nullable()->useCurrent();

            $table->primary(['kode_rujukan'], 'pk_rg_tc_rujukan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rg_tc_rujukan');
    }
};
