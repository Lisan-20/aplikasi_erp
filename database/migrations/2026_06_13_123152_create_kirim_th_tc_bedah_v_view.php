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
        DB::statement("CREATE VIEW dbo.kirim_th_tc_bedah_v
AS
SELECT     *
FROM         (SELECT     ROW_NUMBER() OVER (ORDER BY tgl_rencana) AS RowNum, *
FROM        tc_rencana_operasi
WHERE    status=0 ) AS RowConstrainedResult
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kirim_th_tc_bedah_v]");
    }
};
