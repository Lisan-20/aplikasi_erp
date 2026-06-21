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
        if (Schema::hasTable('patients')) {
            return;
        }

        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_mr')->index();
            $table->integer('no_urutan')->nullable();
            $table->string('full_name')->index();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('religion_code')->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('ktp_number', 20)->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('phone_home')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_local')->nullable();
            $table->integer('category_code')->nullable();
            $table->integer('company_code')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('class_code')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_job')->nullable();
            $table->time('birth_time', 7)->nullable();
            $table->decimal('birth_weight', 5)->nullable();
            $table->decimal('birth_length', 5)->nullable();
            $table->string('skin_color')->nullable();
            $table->string('bracelet_number')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('village_id')->nullable();
            $table->integer('hamlet_id')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();

            $table->unique(['no_mr']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
