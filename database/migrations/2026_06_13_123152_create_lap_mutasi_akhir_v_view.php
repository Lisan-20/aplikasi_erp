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
        DB::statement("CREATE VIEW dbo.lap_mutasi_akhir_v
AS
SELECT     kode_brg, SUM(stok_akhir) AS stok_akhir, MONTH(tgl_input) AS bulan, YEAR(tgl_input) AS tahun
FROM         dbo.tc_kartu_stok
GROUP BY kode_brg, MONTH(tgl_input), YEAR(tgl_input)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_mutasi_akhir_v]");
    }
};
