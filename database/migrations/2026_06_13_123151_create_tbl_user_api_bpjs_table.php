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
        if (Schema::hasTable('tbl_user_api_bpjs')) {
            return;
        }

        Schema::create('tbl_user_api_bpjs', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('username', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->string('kode', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_api_bpjs');
    }
};
