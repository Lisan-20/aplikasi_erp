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
        if (Schema::hasTable('mt_ket_his_baru')) {
            return;
        }

        Schema::create('mt_ket_his_baru', function (Blueprint $table) {
            $table->increments('id_ket_his');
            $table->string('ket_his', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_ket_his_baru');
    }
};
