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
        DB::statement("CREATE OR ALTER VIEW dbo.v_diag_bpjs
AS
SELECT        CAST(Code AS varchar) AS Code, Description, Severity, InPatient, OutPatient, CAST(InPatient + '-' + 'i' AS varchar) AS code_inacbg, Code AS kode
FROM            dbo.refdiagnosis
WHERE        (Code = '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_diag_bpjs]");
    }
};
