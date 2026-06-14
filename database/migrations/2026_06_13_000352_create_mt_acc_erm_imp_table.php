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
        if (Schema::hasTable('mt_acc_erm_imp')) {
            return;
        }

        Schema::create('mt_acc_erm_imp', function (Blueprint $table) {
            $table->increments('id_imp');
            $table->string('kd_periksa', 8)->nullable();
            $table->text('nama_implementasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_acc_erm_imp');
    }
};
