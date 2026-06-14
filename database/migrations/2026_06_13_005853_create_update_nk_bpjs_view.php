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
        DB::statement("CREATE OR ALTER VIEW dbo.update_nk_bpjs
AS
SELECT     dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.nk_bpjs, dbo.tc_trans_jkn.plafon, 
                      dbo.tc_trans_kasir.no_registrasi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_jkn ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_jkn.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.nk_bpjs > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_nk_bpjs]");
    }
};
