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
        if (Schema::hasTable('tc_penerimaan_inst')) {
            return;
        }

        Schema::create('tc_penerimaan_inst', function (Blueprint $table) {
            $table->increments('id_tc_penerimaan_inst');
            $table->integer('id_tc_permintaan_inst_det')->nullable();
            $table->dateTime('tgl_terima')->nullable();
            $table->string('kode_brg', 50)->nullable();
            $table->decimal('jumlah_penerimaan', 18, 0)->nullable();
            $table->string('yg_terima', 50)->nullable();
            $table->string('yg_serah', 50)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_penerimaan_inst');
    }
};
