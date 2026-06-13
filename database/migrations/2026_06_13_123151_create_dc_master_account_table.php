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
        Schema::create('dc_master_account', function (Blueprint $table) {
            $table->integer('acc_no');
            $table->string('acc_nama', 50)->nullable();
            $table->string('kat', 10)->nullable();
            $table->string('type', 10)->nullable();
            $table->string('m_s', 10)->nullable();
            $table->tinyInteger('acc_status')->nullable();
            $table->string('acc_type', 1)->nullable();
            $table->tinyInteger('acc_level')->nullable();

            $table->primary(['acc_no'], 'pk_dc_master_account');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_master_account');
    }
};
