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
        if (Schema::hasTable('mt_plafon_bpjs_rawat_jalan')) {
            return;
        }

        Schema::create('mt_plafon_bpjs_rawat_jalan', function (Blueprint $table) {
            $table->increments('id_mt_plafon');
            $table->decimal('plafon', 19, 4)->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->string('kode_bagian', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_plafon_bpjs_rawat_jalan');
    }
};
