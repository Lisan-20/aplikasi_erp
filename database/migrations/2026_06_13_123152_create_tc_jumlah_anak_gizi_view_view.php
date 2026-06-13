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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_jumlah_anak_gizi_view
AS
SELECT     SUM(jml) AS anak, tgl, bln, thn, distribusi
FROM         dbo.tc_jumlah_gizi_view
WHERE     (umur <= 15)
GROUP BY tgl, bln, thn, distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_jumlah_anak_gizi_view]");
    }
};
