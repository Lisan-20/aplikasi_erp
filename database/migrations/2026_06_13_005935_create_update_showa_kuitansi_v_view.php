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
        DB::statement("CREATE OR ALTER VIEW dbo.update_showa_kuitansi_v
AS
SELECT     dbo.bill_showa_v.kode_perusahaan, dbo.bill_showa_v.no_registrasi, dbo.bill_showa_v.status_batal, SUM(dbo.bill_showa_v.diskon_total) 
                      AS diskon_total, SUM(dbo.bill_showa_v.bill_rs_jatah + dbo.bill_showa_v.bill_dr1_jatah + dbo.bill_showa_v.bill_dr2_jatah + dbo.bill_showa_v.lain_lain)
                       AS tot_bill, dbo.bill_showa_v.kode_tc_trans_kasir, 
                      dbo.bill_showa_v.bill_rs_jatah + dbo.bill_showa_v.bill_dr1_jatah + dbo.bill_showa_v.bill_dr2_jatah + dbo.bill_showa_v.lain_lain - dbo.bill_showa_v.diskon_total
                       AS nk, SUM(dbo.tc_trans_kasir.nk_perusahaan) AS nk_perusahaan, SUM(dbo.tc_trans_kasir.bill) AS bill, dbo.tc_trans_kasir.no_kuitansi
FROM         dbo.bill_showa_v INNER JOIN
                      dbo.tc_trans_kasir ON dbo.bill_showa_v.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir AND dbo.bill_showa_v.no_registrasi IN (18408, 
                      18622, 18621, 18707, 18355, 18994, 19163, 19280, 19353, 19445, 19888, 20043, 20095, 20118, 20220)
GROUP BY dbo.bill_showa_v.kode_perusahaan, dbo.bill_showa_v.no_registrasi, dbo.bill_showa_v.status_batal, dbo.bill_showa_v.kode_tc_trans_kasir, 
                      dbo.bill_showa_v.bill_rs_jatah + dbo.bill_showa_v.bill_dr1_jatah + dbo.bill_showa_v.bill_dr2_jatah + dbo.bill_showa_v.lain_lain - dbo.bill_showa_v.diskon_total,
                       dbo.tc_trans_kasir.no_kuitansi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_showa_kuitansi_v]");
    }
};
