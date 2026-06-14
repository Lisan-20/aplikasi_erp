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
        if (Schema::hasTable('tc_retur_unit')) {
            return;
        }

        Schema::create('tc_retur_unit', function (Blueprint $table) {
            $table->increments('id_tc_retur_unit');
            $table->integer('kode_retur');
            $table->string('kode_bagian', 18)->nullable();
            $table->dateTime('tgl_retur')->nullable();
            $table->smallInteger('status')->default(1);
            $table->string('no_induk', 50)->nullable();
            $table->dateTime('tgl_input')->nullable()->useCurrent();
            $table->string('petugas_unit', 50)->nullable();
            $table->string('petugas_gudang', 50)->nullable();

            $table->primary(['id_tc_retur_unit'], 'pk_tc_retur_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_retur_unit');
    }
};
