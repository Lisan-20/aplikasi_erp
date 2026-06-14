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
        if (Schema::hasTable('dd_rujuk_rs')) {
            return;
        }

        Schema::create('dd_rujuk_rs', function (Blueprint $table) {
            $table->increments('id_dd_rujuk_rs');
            $table->string('nama_rs_rujuk')->nullable();

            $table->primary(['id_dd_rujuk_rs'], 'pk_dd_rujuk_rs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_rujuk_rs');
    }
};
