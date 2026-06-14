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
        DB::statement("CREATE OR ALTER VIEW dbo.update_kuitansi_showa_ok
AS
SELECT     dbo.update_showa_kuitansi_v.kode_perusahaan, dbo.update_showa_kuitansi_v.no_registrasi, dbo.update_showa_kuitansi_v.status_batal, 
                      dbo.update_showa_kuitansi_v.diskon_total, dbo.update_showa_kuitansi_v.tot_bill, dbo.update_showa_kuitansi_v.kode_tc_trans_kasir, 
                      dbo.update_showa_kuitansi_v.nk, dbo.update_showa_kuitansi_v.no_kuitansi, dbo.tc_trans_kasir.nk_perusahaan, dbo.tc_trans_kasir.bill, 
                      dbo.tc_trans_kasir.seri_kuitansi
FROM         dbo.update_showa_kuitansi_v INNER JOIN
                      dbo.tc_trans_kasir ON dbo.update_showa_kuitansi_v.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.seri_kuitansi <> 'AI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kuitansi_showa_ok]");
    }
};
