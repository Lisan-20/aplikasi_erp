<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tc_erp_pr', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('tc_erp_pr', function (Blueprint $table) {
            $table->dropColumn('supplier_id');
        });
    }
};
