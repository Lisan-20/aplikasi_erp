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
        if (Schema::hasTable('dc_tab')) {
            return;
        }

        Schema::create('dc_tab', function (Blueprint $table) {
            $table->increments('id_dc_tab');
            $table->integer('id_dc_sub_menu')->nullable();
            $table->string('nama_tab', 50)->nullable();
            $table->string('url_tab', 50)->nullable();
            $table->string('url_tab_default', 50)->nullable();
            $table->integer('jumlah_file')->nullable();
            $table->integer('no_urut_tab')->nullable();
            $table->tinyInteger('status_tab')->nullable()->default(0);

            $table->primary(['id_dc_tab'], 'pk_dc_tab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_tab');
    }
};
