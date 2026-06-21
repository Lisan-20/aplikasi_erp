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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kode_perusahaan_byr_piutang
AS
SELECT     dbo.bd_tc_trans_detail.no_bukti, dbo.tx_harian.kode_perusahaan, dbo.tx_harian.no_bukti AS Expr1, dbo.bd_tc_trans_detail.kode_perusahaan AS kode
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.tx_harian ON dbo.bd_tc_trans_detail.no_bukti = dbo.tx_harian.no_bukti
WHERE     (dbo.bd_tc_trans_detail.no_bukti LIKE '%KU%') AND (dbo.tx_harian.kode_perusahaan = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kode_perusahaan_byr_piutang]");
    }
};
