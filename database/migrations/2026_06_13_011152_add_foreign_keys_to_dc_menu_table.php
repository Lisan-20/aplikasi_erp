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
        if ($this->foreignKeyExists('FK_dc_menu_dc_modul')) {
            return;
        }

        Schema::table('dc_menu', function (Blueprint $table) {
            $table->foreign(['id_dc_modul'], 'FK_dc_menu_dc_modul')->references(['id_dc_modul'])->on('dc_modul')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dc_menu', function (Blueprint $table) {
            $table->dropForeign('FK_dc_menu_dc_modul');
        });
    }

    private function foreignKeyExists(string $name): bool
    {
        return DB::select('SELECT 1 FROM sys.foreign_keys WHERE name = ?', [$name]) !== [];
    }
};
