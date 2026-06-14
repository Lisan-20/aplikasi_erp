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
        if ($this->foreignKeyExists('FK_dc_tab_dc_sub_menu')) {
            return;
        }

        Schema::table('dc_tab', function (Blueprint $table) {
            $table->foreign(['id_dc_sub_menu'], 'FK_dc_tab_dc_sub_menu')->references(['id_dc_sub_menu'])->on('dc_sub_menu')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dc_tab', function (Blueprint $table) {
            $table->dropForeign('FK_dc_tab_dc_sub_menu');
        });
    }

    private function foreignKeyExists(string $name): bool
    {
        return DB::select('SELECT 1 FROM sys.foreign_keys WHERE name = ?', [$name]) !== [];
    }
};
