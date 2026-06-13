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
        Schema::create('bpjs_bedah_new', function (Blueprint $table) {
            $table->string('nama_tindakan')->nullable();
            $table->float('total', 53, 0)->nullable();
            $table->float('no_urut', 53, 0)->nullable();
            $table->float('referensi', 53, 0)->nullable();
            $table->float('bill_dr', 53, 0)->nullable();
            $table->float('bill_rs', 53, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpjs_bedah_new');
    }
};
