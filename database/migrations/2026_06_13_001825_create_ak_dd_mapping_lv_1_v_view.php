<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("


CREATE OR ALTER VIEW dbo.ak_dd_mapping_lv_1_v
AS
SELECT     nama_mapping_kb, level_mapping_kb, kode_mapping_kb
FROM         dbo.ak_dd_mapping_kb
WHERE     (level_mapping_kb = 1)



");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ak_dd_mapping_lv_1_v]");
    }
};
