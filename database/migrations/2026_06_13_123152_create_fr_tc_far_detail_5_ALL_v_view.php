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
        DB::statement("CREATE VIEW dbo.fr_tc_far_detail_5_ALL_v
AS
SELECT     *
FROM       fr_tc_far_detail_1_v
UNION
SELECT     *
FROM       fr_tc_far_detail_2_v
UNION
SELECT     *
FROM       fr_tc_far_detail_3_v
UNION
SELECT     *
FROM       fr_tc_far_detail_4_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_far_detail_5_ALL_v]");
    }
};
