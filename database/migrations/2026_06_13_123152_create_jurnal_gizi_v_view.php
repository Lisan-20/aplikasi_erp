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
        DB::statement("CREATE VIEW dbo.jurnal_gizi_v
AS
SELECT     kode_klas, SUM(biaya_gizi) AS biaya_gizi, kode_kelompok, id_gol
FROM         dbo.tbl_biaya_gizi
GROUP BY kode_klas, kode_kelompok, id_gol
HAVING      (id_gol <> 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_gizi_v]");
    }
};
