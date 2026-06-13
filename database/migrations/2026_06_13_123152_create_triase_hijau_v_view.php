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
        DB::statement("CREATE OR ALTER VIEW dbo.triase_hijau_v
AS
SELECT     COUNT(jml_pas) AS jmlpas, tgl, bln, thn, status_triase
FROM         dbo.lap_kunjungan_igd_all_v
GROUP BY tgl, bln, thn, status_triase
HAVING      (status_triase = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [triase_hijau_v]");
    }
};
