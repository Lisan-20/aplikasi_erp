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
        if ($this->foreignKeyExists('FK_dc_propinsi_dc_negara')) {
            return;
        }

        Schema::table('dc_propinsi', function (Blueprint $table) {
            $table->foreign(['id_dc_negara'], 'FK_dc_propinsi_dc_negara')->references(['id_dc_negara'])->on('dc_negara')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dc_propinsi', function (Blueprint $table) {
            $table->dropForeign('FK_dc_propinsi_dc_negara');
        });
    }

    private function foreignKeyExists(string $name): bool
    {
        return DB::select('SELECT 1 FROM sys.foreign_keys WHERE name = ?', [$name]) !== [];
    }
};
