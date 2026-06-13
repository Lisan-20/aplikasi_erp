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
        DB::statement("CREATE VIEW dbo.alt_procedures_v
AS
SELECT     Code, Code2, Description, Class, Inpatient, Outpatient
FROM         OPENQUERY(MYSQL, 'select * from alt_procedures') AS derivedtbl_1
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [alt_procedures_v]");
    }
};
