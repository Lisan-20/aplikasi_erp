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
        DB::statement("CREATE OR ALTER VIEW dbo.alt_diagnosis_v
AS
SELECT     chapter, s1, code, code2, description, severity, Inpatient, Outpatient
FROM         OPENQUERY(MYSQL, 'select * from alt_diagnosis') AS derivedtbl_1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [alt_diagnosis_v]");
    }
};
