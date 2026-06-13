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
        if (Schema::hasTable('tb_data_obat')) {
            return;
        }

        Schema::create('tb_data_obat', function (Blueprint $table) {
            $table->float('NO', 53, 0)->nullable();
            $table->text('NAMA OBAT')->nullable();
            $table->string('SATUAN')->nullable();
            $table->float('Harga ', 53, 0)->nullable();
            $table->float('quantity', 53, 0)->nullable();
            $table->float('Harga beli', 53, 0)->nullable();
            $table->string('F7')->nullable();
            $table->string('F8')->nullable();
            $table->string('F9')->nullable();
            $table->string('F10')->nullable();
            $table->string('F11')->nullable();
            $table->string('F12')->nullable();
            $table->string('F13')->nullable();
            $table->string('F14')->nullable();
            $table->string('F15')->nullable();
            $table->string('F16')->nullable();
            $table->string('F17')->nullable();
            $table->string('F18')->nullable();
            $table->string('F19')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_obat');
    }
};
