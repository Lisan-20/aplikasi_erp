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
        Schema::create('user_chat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('pass', 50)->nullable();
            $table->integer('id_dd_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_chat');
    }
};
