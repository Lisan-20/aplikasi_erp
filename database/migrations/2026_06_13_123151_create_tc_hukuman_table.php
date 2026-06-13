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
        if (Schema::hasTable('tc_hukuman')) {
            return;
        }

        Schema::create('tc_hukuman', function (Blueprint $table) {
            $table->increments('id_tc_hukuman');
            $table->string('npp', 6)->nullable();
            $table->integer('id_hrdd_hukuman')->nullable();
            $table->string('no_sk_hukuman', 50)->nullable();
            $table->dateTime('tgl_sk_hukuman')->nullable();
            $table->string('pemberi_hukuman', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hukuman');
    }
};
