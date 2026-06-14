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
        if (Schema::hasTable('sie_kinerja_rs_unit')) {
            return;
        }

        Schema::create('sie_kinerja_rs_unit', function (Blueprint $table) {
            $table->increments('id_lap');
            $table->integer('thn')->nullable();
            $table->integer('bln')->nullable();
            $table->decimal('jml_umum', 18, 0)->nullable();
            $table->decimal('jml_bpjs', 18, 0)->nullable();
            $table->decimal('jml_perusahaan', 18, 0)->nullable();
            $table->decimal('tot_umum', 18, 0)->nullable();
            $table->decimal('tot_bpjs', 18, 0)->nullable();
            $table->decimal('tot_perusahaan', 18, 0)->nullable();
            $table->decimal('jml_umum_LL', 18, 0)->nullable();
            $table->decimal('jml_bpjs_LL', 18, 0)->nullable();
            $table->decimal('jml_perusahaan_LL', 18, 0)->nullable();
            $table->decimal('tot_umum_LL', 18, 0)->nullable();
            $table->decimal('tot_bpjs_LL', 18, 0)->nullable();
            $table->decimal('tot_perusahaan_LL', 18, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sie_kinerja_rs_unit');
    }
};
