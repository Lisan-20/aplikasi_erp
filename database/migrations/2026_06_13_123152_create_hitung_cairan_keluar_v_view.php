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
        DB::statement("CREATE VIEW dbo.hitung_cairan_keluar_v
AS
SELECT     no_kunjungan, SUM(hasil_x) AS hasil_x, no_imbang
FROM         dbo.tc_pemeriksaan_cairan_det
GROUP BY no_kunjungan, kode_pemeriksaan, no_imbang
HAVING      (kode_pemeriksaan IN (74201, 74202, 74203, 74204, 74205))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_cairan_keluar_v]");
    }
};
