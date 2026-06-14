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
        if (Schema::hasTable('tc_chatting_reply')) {
            return;
        }

        Schema::create('tc_chatting_reply', function (Blueprint $table) {
            $table->increments('id_chat');
            $table->text('isi_chat')->nullable();
            $table->integer('pengirim')->nullable();
            $table->integer('penerima')->nullable();
            $table->dateTime('tgl_chat')->nullable();
            $table->integer('chat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_chatting_reply');
    }
};
