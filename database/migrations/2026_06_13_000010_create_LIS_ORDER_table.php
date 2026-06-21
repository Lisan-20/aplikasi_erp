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
        if (Schema::hasTable('LIS_ORDER')) {
            return;
        }

        Schema::create('LIS_ORDER', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('MESSAGE_DT', 14)->nullable();
            $table->string('ORDER_CONTROL', 2)->nullable();
            $table->string('PID', 16)->nullable();
            $table->string('PNAME', 50)->nullable();
            $table->text('ADDRESS')->nullable();
            $table->string('PTYPE', 2)->nullable();
            $table->string('BIRTH_DT', 14)->nullable();
            $table->string('SEX', 1)->nullable();
            $table->string('ONO', 20)->nullable();
            $table->string('REQUEST_DT', 14)->nullable();
            $table->string('SOURCE', 60)->nullable();
            $table->string('CLINICIAN', 60)->nullable();
            $table->string('ROOM_NO2', 6)->nullable();
            $table->string('PRIORITY', 1)->nullable();
            $table->text('COMMENT')->nullable();
            $table->string('VISITNO', 20)->nullable();
            $table->text('ORDER_TESTID')->nullable();
            $table->integer('FLAG_STATUS')->default(0);
            $table->integer('FLAG_EDIT')->default(0);
            $table->integer('KIRIM')->nullable();
            $table->string('ROOM_NO', 70)->nullable();

            $table->primary(['ID'], 'pk_lis_order2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LIS_ORDER');
    }
};
