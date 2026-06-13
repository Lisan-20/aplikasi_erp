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
        Schema::create('dd_user_group_detail', function (Blueprint $table) {
            $table->increments('id_dd_user_group_detail');
            $table->integer('id_dd_user_group')->nullable();
            $table->integer('id_dc_sub_menu')->nullable();
            $table->integer('hak_akses_menu')->nullable();
            $table->string('keterangan')->nullable();

            $table->primary(['id_dd_user_group_detail'], 'pk_dd_user_group_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_user_group_detail');
    }
};
