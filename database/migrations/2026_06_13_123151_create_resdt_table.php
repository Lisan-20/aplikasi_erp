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
        if (Schema::hasTable('resdt')) {
            return;
        }

        Schema::create('resdt', function (Blueprint $table) {
            $table->string('ID', 30);
            $table->string('ONO', 20);
            $table->string('SEQNO', 6);
            $table->string('TEST_CD', 20);
            $table->string('TEST_NM', 30)->nullable();
            $table->string('DATA_TYP', 2)->nullable();
            $table->string('RESULT_VALUE', 40)->nullable();
            $table->string('RESULT_FT', 8000)->nullable();
            $table->string('UNIT', 15)->nullable();
            $table->string('FLAG', 2)->nullable();
            $table->string('REF_RANGE', 30)->nullable();
            $table->string('STATUS', 1)->nullable();
            $table->string('TEST_COMMENT', 300)->nullable();
            $table->string('VALIDATE_BY', 60)->nullable();
            $table->string('VALIDATE_ON', 14)->nullable();
            $table->string('DISP_SEQ', 15)->nullable();
            $table->string('ORDER_TESTID', 6)->nullable();
            $table->string('ORDER_TESTNM', 30)->nullable();
            $table->string('TEST_GROUP', 20)->nullable();
            $table->string('ITEM_PARENT', 6)->nullable();
            $table->integer('FLAG_KIRIM')->nullable();

            $table->primary(['ID', 'ONO', 'SEQNO', 'TEST_CD']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resdt');
    }
};
