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
        DB::statement("CREATE OR ALTER VIEW dbo.view_alt_diagnosis_split
AS
SELECT        Inpatient, code2, chapter, s1, code, description, severity, inacbg_inp
FROM            dbo.alt_diagnosis_split_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_alt_diagnosis_split]");
    }
};
