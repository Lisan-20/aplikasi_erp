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
        Schema::create('tc_penilaian_kinerja_det', function (Blueprint $table) {
            $table->increments('id_tc_kinerja_det');
            $table->integer('id_tc_kinerja')->nullable();
            $table->integer('id_hrdd_kinerja')->nullable();
            $table->decimal('nilai', 5)->nullable();
            $table->decimal('jml_bobot', 5)->nullable();
            $table->decimal('nilai_bobot', 5)->nullable();
            $table->decimal('total_nilai', 5)->nullable();
            $table->decimal('resume', 6, 4)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('id_kinerja_det')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penilaian_kinerja_det');
    }
};
