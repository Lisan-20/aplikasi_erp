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
        Schema::create('tc_referensi_nm', function (Blueprint $table) {
            $table->integer('id_tc_ref');
            $table->string('kode_ref', 25)->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->dateTime('tgl_ref')->nullable();
            $table->dateTime('tgl_inp')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('status_batal')->nullable();
            $table->integer('kodesupplier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_referensi_nm');
    }
};
