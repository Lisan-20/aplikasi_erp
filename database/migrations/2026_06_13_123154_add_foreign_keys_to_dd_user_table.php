<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if ($this->foreignKeyExists('FK_dd_user_dd_group')) {
            return;
        }

        Schema::table('dd_user', function (Blueprint $table) {
            $table->foreign(['id_dd_group'], 'FK_dd_user_dd_group')->references(['id_dd_group'])->on('dd_group')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dd_user', function (Blueprint $table) {
            $table->dropForeign('FK_dd_user_dd_group');
        });
    }

    private function foreignKeyExists(string $name): bool
    {
        return DB::select('SELECT 1 FROM sys.foreign_keys WHERE name = ?', [$name]) !== [];
    }
};
