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
        DB::statement("CREATE VIEW dbo.v_paramedis_gabung
AS
SELECT     *
FROM         v_paramedis_3
UNION
SELECT     *
FROM         v_paramedis_2
UNION
SELECT     *
FROM         v_paramedis_1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_paramedis_gabung]");
    }
};
