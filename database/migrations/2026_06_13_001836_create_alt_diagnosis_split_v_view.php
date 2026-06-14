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
        DB::statement("CREATE OR ALTER VIEW dbo.alt_diagnosis_split_v
AS
SELECT     A.[Inpatient], A.[code2], A.[chapter], A.[s1], A.[code], A.[description], A.[severity], Split.a.value('.', 'VARCHAR(100)') AS inacbg_inp
FROM         (SELECT    [Inpatient], [code2], [chapter], [s1], [code], [description], [severity], CAST('<M>' + REPLACE([inacbg_in], ',', '</M><M>') + '</M>' AS XML) AS inacbg_inp
                       FROM          alt_diagnosis) AS A CROSS APPLY inacbg_inp.nodes('/M') AS Split(a);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [alt_diagnosis_split_v]");
    }
};
