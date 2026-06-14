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
        DB::statement("CREATE OR ALTER VIEW dbo.sep_upd_sep_ok_v
AS
SELECT     dbo.sep_upd_billing_v.thn, dbo.sep_upd_billing_v.bln, dbo.sep_upd_billing_v.tgl, dbo.sep_upd_billing_v.no_mr, dbo.sep_upd_sep_v.no_mr AS Expr1, 
                      dbo.sep_upd_sep_v.TariffRS, dbo.sep_upd_billing_v.nk_perusahaan, dbo.sep_upd_billing_v.noSep, dbo.sep_upd_sep_v.NoSep AS nosep_up
FROM         dbo.sep_upd_billing_v INNER JOIN
                      dbo.sep_upd_sep_v ON dbo.sep_upd_billing_v.tgl = dbo.sep_upd_sep_v.tgl AND dbo.sep_upd_billing_v.bln = dbo.sep_upd_sep_v.bln AND 
                      dbo.sep_upd_billing_v.thn = dbo.sep_upd_sep_v.thn AND dbo.sep_upd_billing_v.nk_perusahaan = dbo.sep_upd_sep_v.TariffRS AND 
                      dbo.sep_upd_billing_v.no_mr = dbo.sep_upd_sep_v.no_mr
WHERE     (dbo.sep_upd_billing_v.noSep IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sep_upd_sep_ok_v]");
    }
};
