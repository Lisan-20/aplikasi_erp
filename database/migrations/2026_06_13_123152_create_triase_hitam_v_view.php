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
        DB::statement("CREATE VIEW dbo.triase_hitam_v
AS
SELECT     status_triase, COUNT(jml_pas) AS jmlpas, tgl, bln, thn
FROM         dbo.lap_kunjungan_igd_all_v
GROUP BY status_triase, tgl, bln, thn
HAVING      (status_triase = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [triase_hitam_v]");
    }
};
