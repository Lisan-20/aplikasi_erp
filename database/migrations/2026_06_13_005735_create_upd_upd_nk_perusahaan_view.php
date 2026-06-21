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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_upd_nk_perusahaan
AS
SELECT     dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.nk_perusahaan, dbo.update_nk_perusahaan.nk_asli, 
                      dbo.update_nk_perusahaan.diskon, dbo.tc_trans_kasir.no_registrasi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.update_nk_perusahaan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.update_nk_perusahaan.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.tunai > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_upd_nk_perusahaan]");
    }
};
