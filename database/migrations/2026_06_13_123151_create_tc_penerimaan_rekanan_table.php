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
        Schema::create('tc_penerimaan_rekanan', function (Blueprint $table) {
            $table->integer('id_tc_penerimaan_rekanan');
            $table->dateTime('tgl_terima')->nullable();
            $table->string('yg_terima', 50)->nullable();
            $table->string('yg_serah', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->string('selesai', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_rekanan');
    }
};
