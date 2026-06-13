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
        Schema::create('USERINFO', function (Blueprint $table) {
            $table->integer('USERID')->nullable();
            $table->string('Badgenumber', 50)->nullable();
            $table->string('SSN', 50)->nullable();
            $table->string('Name', 100)->nullable();
            $table->string('Gender', 50)->nullable();
            $table->string('TITLE', 100)->nullable();
            $table->string('PAGER', 50)->nullable();
            $table->dateTime('BIRTHDAY')->nullable();
            $table->dateTime('HIREDDAY')->nullable();
            $table->text('street')->nullable();
            $table->text('CITY')->nullable();
            $table->text('STATE')->nullable();
            $table->text('ZIP')->nullable();
            $table->text('OPHONE')->nullable();
            $table->text('FPHONE')->nullable();
            $table->integer('VERIFICATIONMETHOD')->nullable();
            $table->integer('DEFAULTDEPTID')->nullable();
            $table->integer('SECURITYFLAGS')->nullable();
            $table->integer('ATT')->nullable();
            $table->integer('INLATE')->nullable();
            $table->integer('OUTEARLY')->nullable();
            $table->integer('OVERTIME')->nullable();
            $table->integer('SEP')->nullable();
            $table->integer('HOLIDAY')->nullable();
            $table->text('MINZU')->nullable();
            $table->text('PASSWORD')->nullable();
            $table->integer('LUNCHDURATION')->nullable();
            $table->text('PHOTO')->nullable();
            $table->text('mverifypass')->nullable();
            $table->text('Notes')->nullable();
            $table->integer('privilege')->nullable();
            $table->integer('InheritDeptSch')->nullable();
            $table->integer('InheritDeptSchClass')->nullable();
            $table->integer('AutoSchPlan')->nullable();
            $table->integer('MinAutoSchInterval')->nullable();
            $table->integer('RegisterOT')->nullable();
            $table->integer('InheritDeptRule')->nullable();
            $table->integer('EMPRIVILEGE')->nullable();
            $table->text('CardNo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('USERINFO');
    }
};
