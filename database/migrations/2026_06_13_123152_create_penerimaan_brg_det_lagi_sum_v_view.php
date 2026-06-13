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
        DB::statement("CREATE VIEW dbo.penerimaan_brg_det_lagi_sum_v
AS
SELECT     TOP (100) PERCENT no_po, tgl_po, namasupplier, COUNT(kode_brg) AS sisa_pesan, YEAR(tgl_po) AS Expr1, id_tc_po, GETDATE() AS now, DATEDIFF(DD, tgl_po, GETDATE()) AS sdh_berlaku, 
                      35 - DATEDIFF(DD, tgl_po, GETDATE()) AS berlaku, kode_bagian, flag_is
FROM         dbo.penerimaan_brg_det_lagi_v
GROUP BY no_po, tgl_po, namasupplier, YEAR(tgl_po), id_tc_po, DATEDIFF(DD, tgl_po, GETDATE()), 35 - DATEDIFF(DD, tgl_po, GETDATE()), kode_bagian, flag_is
HAVING      (YEAR(tgl_po) >= 2015) AND (COUNT(kode_brg) > 0) AND (35 - DATEDIFF(DD, tgl_po, GETDATE()) >= 1)
ORDER BY no_po DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_det_lagi_sum_v]");
    }
};
