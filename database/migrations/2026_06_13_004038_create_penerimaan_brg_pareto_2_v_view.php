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
        DB::statement("CREATE OR ALTER VIEW dbo.penerimaan_brg_pareto_2_v
AS
SELECT     TOP (100) PERCENT dbo.penerimaan_brg_pareto_1_v.bln, dbo.penerimaan_brg_pareto_1_v.thn, dbo.penerimaan_brg_pareto_1_v.nama_brg, dbo.penerimaan_brg_pareto_1_v.kode_brg, 
                      SUM(dbo.penerimaan_brg_pareto_1_v.masuk_gdg) AS masuk_gdg, dbo.mt_rekap_stok.harga_beli, dbo.penerimaan_brg_pareto_1_v.flag_is
FROM         dbo.penerimaan_brg_pareto_1_v INNER JOIN
                      dbo.mt_rekap_stok ON dbo.penerimaan_brg_pareto_1_v.kode_brg = dbo.mt_rekap_stok.kode_brg
GROUP BY dbo.penerimaan_brg_pareto_1_v.bln, dbo.penerimaan_brg_pareto_1_v.thn, dbo.penerimaan_brg_pareto_1_v.nama_brg, dbo.penerimaan_brg_pareto_1_v.kode_brg, 
                      dbo.mt_rekap_stok.harga_beli, dbo.penerimaan_brg_pareto_1_v.flag_is
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penerimaan_brg_pareto_2_v]");
    }
};
