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
        if (Schema::hasTable('log_user_login')) {
            return;
        }

        Schema::create('log_user_login', function (Blueprint $table) {
            $table->increments('id_log_user');
            $table->integer('id_dd_user')->nullable();
            $table->string('session_id', 50)->nullable();
            $table->dateTime('login_time')->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->dateTime('logoff_time')->nullable();
            $table->integer('ko_wil')->nullable();

            $table->primary(['id_log_user'], 'pk_log_user_login_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_user_login');
    }
};
