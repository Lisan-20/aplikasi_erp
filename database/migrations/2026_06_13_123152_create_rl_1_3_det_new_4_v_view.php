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
        DB::statement("CREATE OR ALTER VIEW dbo.rl_1_3_det_new_4_v
AS
SELECT     *
FROM         dbo.rl_1_3_det_new_3_v
UNION 
SELECT     *
FROM         dbo.rl_1_3_det_new_2_v 
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_1_3_det_new_4_v]");
    }
};
