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
        if (Schema::hasTable('th_sep_rujukan')) {
            return;
        }

        Schema::create('th_sep_rujukan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_mr', 6)->nullable();
            $table->string('no_kartu', 20)->nullable();
            $table->string('no_rujukan', 50)->nullable();
            $table->dateTime('tgl_rujukan')->nullable();
            $table->integer('jumlah_sep')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_sep_rujukan');
    }
};
