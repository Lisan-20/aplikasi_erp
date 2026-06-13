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
        DB::statement("CREATE VIEW dbo.lap_rekap_resep_Nonracik_v
AS
SELECT     TOP (100) PERCENT COUNT(kode_trans_far) AS non_racik, DAY(tgl_trans) AS tgl, MONTH(tgl_trans) AS bln, YEAR(tgl_trans) AS thn
FROM         dbo.lap_rekap_resep_new_v
WHERE     (kode_bagian = '060101') AND (status_retur IS NULL) AND (status_transaksi = 1) AND (kode_trans_far NOT IN
                          (SELECT     kode_trans_far
                            FROM          dbo.tbl_obat_racikan_temp))
GROUP BY DAY(tgl_trans), MONTH(tgl_trans), YEAR(tgl_trans)
ORDER BY tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_Nonracik_v]");
    }
};
