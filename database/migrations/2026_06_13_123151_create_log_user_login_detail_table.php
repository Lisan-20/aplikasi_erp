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
        Schema::create('log_user_login_detail', function (Blueprint $table) {
            $table->increments('id_log_user_login_detail');
            $table->integer('id_log_user')->nullable();
            $table->dateTime('login_time_detail')->nullable();
            $table->integer('id_dc_modul')->nullable();
            $table->integer('id_dc_menu')->nullable();
            $table->integer('id_dc_sub_menu')->nullable();
            $table->integer('hak_akses')->nullable();
            $table->tinyInteger('status')->nullable();

            $table->primary(['id_log_user_login_detail'], 'pk_log_user_login_detail_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_user_login_detail');
    }
};
